## INSTALL TELESCOPE
1. composer require laravel/telescope
2. php artisan telescope:install
3. php artisan migrate
4. localhost/telescope


#CRUD
1. php artisan make:model Post -mcr
2. Schema::create('posts', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('content');
        $table->timestamps();
   });
3. membuat crud