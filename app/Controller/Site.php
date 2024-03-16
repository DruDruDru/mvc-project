<?php

namespace Controller;

use Model\Room;
use Model\Subdivision;
use Model\Subscriber;
use Model\Telephone;
use Src\Auth\Auth;
use Src\Protect;
use Src\Request;
use Src\Validator\Validator;
use Src\View;
use Model\Post;
use Model\User;
use Illuminate\Database\Capsule\Manager as DB;

class Site
{
    public function index(Request $request): string
    {
        $posts = Post::where('id', $request->id)->get();
        return (new View())->render('site.post', ['posts' => $posts]);
    }

    public function hello(): string
    {
        return new View('site.hello', ['message' => 'hello working']);
    }

    public function signup(Request $request): string
    {
        if ($request->method === 'POST') {

            $validator = new Validator($request->all(), [
                'login' => ['required', 'unique:users,login'],
                'password' => ['required']
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально'
            ]);

            if($validator->fails()){
                return new View('site.signup',
                    ['message' => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
            }

            if (User::create($request->all())) {
                app()->route->redirect('/panel');
            }
        }
        return new View('site.signup');
    }


    public function login(Request $request): string
    {
        //Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        //Если удалось аутентифицировать пользователя, то редирект
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/hello');
        }
        //Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/hello');
    }

    public function panel(Request $request): string
    {
        if ($request->method === 'POST') {
            $model = $request->all()['model'];

            switch (true) {
                case Protect::check_string($model, "subdivision"):
                    Subdivision::create($request->all());
                    break;
                case Protect::check_string($model, "subscriber"):
                    Subscriber::create($request->all());
                    break;
                case Protect::check_string($model, "room"):
                    Room::create($request->all());
                    break;
                case Protect::check_string($model, "telephone"):
                    Telephone::create($request->all());
                    break;
            }
        }

        $subdivisions = Subdivision::all();
        $subscribers = Subscriber::all();
        $rooms = Room::all();
        $telephones = Telephone::all();

        $rooms_types = DB::table('rooms_types')->get();
        $subdivisions_types = DB::table('subdivisions_types')->get();

        return (new View)->render('site.panel', ["subdivisions" => $subdivisions, "subscribers" => $subscribers,
                                            "rooms" => $rooms, "rooms_types" => $rooms_types,
                                            "subdivisions_types" => $subdivisions_types, "telephones" => $telephones]);
    }
}
