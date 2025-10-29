<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Str;

class ReviewsController extends Controller
{
    public function index()
    {
        $publishedReviews = Review::published()->ordered()->get();
        
        // Получаем ID пользователя из сессии (если есть)
        $userId = session('user_id');
        $userReviews = collect();
        
        if ($userId) {
            $userReviews = Review::where('user_id', $userId)
                ->where('is_moderated', false)
                ->where('is_active', true)
                ->ordered()
                ->get();
        }
        
        $reviews = $publishedReviews->merge($userReviews);
        
        return view('reviews.index', compact('reviews'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'text' => 'required|string|max:130',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'name.required' => 'Имя обязательно для заполнения',
            'text.required' => 'Текст отзыва обязателен для заполнения',
            'text.max' => 'Текст отзыва не должен превышать 130 символов',
            'image.required' => 'Изображение обязательно для загрузки',
            'image.image' => 'Файл должен быть изображением',
            'image.mimes' => 'Изображение должно быть в формате jpeg, png, jpg или gif',
            'image.max' => 'Размер изображения не должен превышать 2MB'
        ]);

        $imagePath = 'antique_1.png';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/content/reviews');
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            $image->move($destinationPath, $imageName);
            $imagePath = $imageName;
        }

        // Генерируем уникальный ID пользователя для сессии
        $userId = session('user_id', Str::random(20));
        if (!session('user_id')) {
            session(['user_id' => $userId]);
        }

        Review::create([
            'user_id' => $userId,
            'name' => $request->name,
            'text' => $request->text,
            'image' => $imagePath,
            'is_moderated' => false,
            'is_active' => true,
            'sort_order' => 0
        ]);

        return redirect()->route('reviews')->with('success', 'Отзыв отправлен на модерацию. Спасибо!');
    }
}
