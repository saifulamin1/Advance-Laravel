## INSTALL TRANSLATE
1. composer require astrotomic/laravel-translatable
2. php artisan vendor:publish --tag=translatable
3. rubah table post 
        Schema::create('posts', function(Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
        });
4. buat table post_translations
   #  php artisan make:migration create_post_translations
   Schema::create('post_translations', function(Blueprint $table) {
        $table->increments('id');
        $table->integer('post_id')->unsigned();
        $table->string('locale')->index();
        $table->string('title');
        $table->text('content');

        $table->unique(['post_id', 'locale']);
        $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
   });
5. rubah model Post
        use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
        use Astrotomic\Translatable\Translatable;

        class Post extends Model implements TranslatableContract
        {
        use Translatable;

        public $translatedAttributes = ['title', 'content'];
        protected $fillable = ['author'];
        }

6. Buat model PostTranslation
        class PostTranslation extends Model
        {
                public $timestamps = false;
                protected $fillable = ['title', 'content'];
        }
7.  php artisan migrate:fresh
