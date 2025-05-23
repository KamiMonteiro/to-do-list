
# To-Do List (Laravel)

Este é um projeto de uma lista de tarefas (To-Do List) desenvolvido com Laravel. Ele permite que usuários registrem, editem, concluam e excluam tarefas com autenticação de usuários.

## 🚀 Tecnologias

- Laravel 12
- PHP 8.4
- SQLite
- Bootstrap 5
- Blade (Laravel Templating)
- Auth Breeze

## ✅ Funcionalidades

- Cadastro e login de usuários
- Criação, edição, exclusão e conclusão de tarefas
- Filtro por status (pendente ou concluída)
- Paginação
- Responsivo (mobile-friendly)
- Envio de e-mail (configurável via SMTP)

## 📦 Instalação

1. Clone o repositório:
```bash
git clone https://github.com/KamiMonteiro/to-do-list.git
cd to-do-list
```

2. Instale as dependências:

# Certifique-se de ter o Node.js, NPM, Composer e PHP 8.4 instalados, também verificar dentro do php.ini a permissão de extensões do sqlite e fileinfo 
```bash
composer install
npm install && npm run dev
```

3. Configure o ambiente:
```bash
cp .env.example .env
php artisan key:generate
```

4. Configure o banco de dados no arquivo .env:
```env
DB_CONNECTION=sqlite
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

5. Execute as migrações:
```bash
php artisan migrate
```

6. Configure o envio de e-mails no .env (opcional):
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=seu-email@gmail.com
MAIL_PASSWORD=sua-senha-de-aplicativo
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=seu-email@gmail.com
MAIL_FROM_NAME="To-Do App"
```

7. Rode o servidor local:
```bash
php artisan serve
```

8. Acesse:
```
http://localhost:8000
```

## 🧪 Testes

Se o projeto tiver testes:
```bash
php artisan test
```

## ✨ Contribuição

Sinta-se à vontade para abrir issues ou pull requests.

## 📄 Licença

Este projeto é open-source sob a licença MIT.
