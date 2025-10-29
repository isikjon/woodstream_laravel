#!/bin/bash
# Команды для обновления проекта на сервере через Git
# Выполните эти команды на сервере в директории ~/www/dev.woodstream.online

# URL репозитория
REPO_URL="https://github.com/isikjon/woodstream_laravel.git"
BRANCH="main"

echo "=== Настройка Git на сервере ==="

# 1. Переход в директорию проекта (если еще не там)
# cd ~/www/dev.woodstream.online

# 2. Инициализация Git (если .git еще не существует)
echo "Инициализация Git..."
git init

# 3. Добавление remote репозитория
echo "Добавление remote..."
git remote add origin $REPO_URL 2>/dev/null || git remote set-url origin $REPO_URL

# 4. Получение всех веток
echo "Получение данных из репозитория..."
git fetch origin

# 5. Переключение/создание ветки main и форсирование обновления
echo "Форсирование обновления до main..."
git checkout -B $BRANCH origin/$BRANCH

# 6. Жесткий сброс к состоянию из репозитория (это перезапишет все локальные изменения)
git reset --hard origin/$BRANCH

# 7. Очистка untracked файлов (опционально, удалит файлы не отслеживаемые git)
# ВНИМАНИЕ: Раскомментируйте следующую строку только если уверены, что хотите удалить все файлы не из git
# git clean -fd

echo "=== Готово! Проект обновлен до последней версии из main ветки ==="

# Альтернативный вариант (если хотите сохранить локальные изменения сначала):
# git add -A
# git stash
# git checkout -B main origin/main
# git reset --hard origin/main
# git stash pop  # вернет ваши изменения (может быть конфликт)

