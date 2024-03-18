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
        $telephones = Telephone::all();
        $subdivisions = Subdivision::all() ?? [];
        $subscribers = Subscriber::all() ?? [];
        $rooms = Room::all() ?? [];

        $rooms_types = DB::table('rooms_types')->get() ?? [];
        $subdivisions_types = DB::table('subdivisions_types')->get() ?? [];

        if ($request->method === 'POST') {
            $telephones = Telephone::all();
            $subscribersCount = count(array_unique($telephones->pluck('subscriber_id')->toArray()));
            $model = $request->all()['model'];
            switch (true) {

                case Protect::check_string($model, "subdivision"):
                    $validator = new Validator($request->all(), [
                        'type' => ['required'],
                        'name' => ['required']
                    ], [
                        'required' => 'Поле :field должно быть заполнено',
                    ]);
                    if ($validator->fails()) {
                        return new View('site.panel', ["subdivisions" => $subdivisions, "subscribers" => $subscribers,
                            "rooms" => $rooms, "rooms_types" => $rooms_types,
                            "subdivisions_types" => $subdivisions_types, "telephones" => $telephones,
                            "subscribersCount" => $subscribersCount,
                            "subdivisionErrors" => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
                    } else {
                        Subdivision::create($request->all());
                    }
                    break;

                case Protect::check_string($model, "subscriber"):
                    $validator = new Validator($request->all(), [
                        'firstname' => ['required'],
                        'lastname' => ['required'],
                        'birth_date' => ['required']
                    ], [
                        'required' => 'Поле :field должно быть заполнено',
                    ]);
                    if ($validator->fails()) {
                        return new View('site.panel', ["subdivisions" => $subdivisions, "subscribers" => $subscribers,
                            "rooms" => $rooms, "rooms_types" => $rooms_types,
                            "subdivisions_types" => $subdivisions_types, "telephones" => $telephones,
                            "subscribersCount" => $subscribersCount,
                            "subscriberErrors" => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
                    } else {
                        Subscriber::create($request->all());
                    }
                    break;

                case Protect::check_string($model, "room"):
                    $validator = new Validator($request->all(), [
                        'room_num' => ['required', 'unique:rooms,room_num'],
                        'name' => ['required'],
                        'type' => ['required'],
                        'subdivision_id' => ['required']
                    ], [
                        'required' => 'Поле :field должно быть заполнено',
                        'unique' => 'Поле :field должно быть уникально'
                    ]);
                    if ($validator->fails()) {
                        return new View('site.panel', ["subdivisions" => $subdivisions, "subscribers" => $subscribers,
                            "rooms" => $rooms, "rooms_types" => $rooms_types,
                            "subdivisions_types" => $subdivisions_types, "telephones" => $telephones,
                            "subscribersCount" => $subscribersCount,
                            "roomErrors" => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
                    } else {
                        Room::create($request->all());
                    }
                    break;

                case Protect::check_string($model, "telephone"):
                    $validator = new Validator($request->all(), [
                        'telephone_number' => ['required', 'unique:telephones,telephone_number',
                            'regex:/^\s?(\+\s?7|8)([- ()]*\d){10}$/'],
                        'room_num' => ['required'],
                        'subscriber_id' => ['required']
                    ], [
                        'required' => 'Поле :field должно быть заполнено',
                        'unique' => 'Такой номер уже занят',
                        'regex' => 'Номер должен быть записан в форме: /^\s?(\+\s?7|8)([- ()]*\d){10}$/'
                    ]);
                    if ($validator->fails()) {
                        return new View('site.panel', ["subdivisions" => $subdivisions, "subscribers" => $subscribers,
                            "rooms" => $rooms, "rooms_types" => $rooms_types,
                            "subdivisions_types" => $subdivisions_types, "telephones" => $telephones,
                            "subscribersCount" => $subscribersCount,
                            "telephoneErrors" => json_encode($validator->errors(), JSON_UNESCAPED_UNICODE)]);
                    } else {
                        Telephone::create($request->all());
                    }
                    break;
            }
        }

        if ($request->method === 'GET') {
            $telephones = Telephone::all();
            $subscriber = $request->all()['subscriber'] ?? "all";
            $room = $request->all()['room'] ?? "all";
            $subdivision = $request->all()['subdivision'] ?? "all";

            if ($subscriber !== 'all' && (int)$subscriber) {
                $telephones = $telephones->where('subscriber_id', $subscriber);
            }
            if ($room !== 'all' && (int)$room) {
                $telephones = $telephones->where('room_num', $room);
            }
            if ($subdivision !== 'all' && (int)$subdivision) {
                $telephones = $telephones->whereIn(
                    'room_num',
                    Room::where('subdivision_id', $subdivision)->pluck('room_num')->toArray()
                );
            }
            $subscribersCount = count(array_unique($telephones->pluck('subscriber_id')->toArray()));
        }

        return (new View)->render('site.panel', ["subdivisions" => $subdivisions, "subscribers" => $subscribers,
                                            "rooms" => $rooms, "rooms_types" => $rooms_types,
                                            "subdivisions_types" => $subdivisions_types, "telephones" => $telephones,
                                            "subscribersCount" => $subscribersCount ?? 0]);
    }
    public function search(Request $request)
    {
        $rooms = Room::all();
        $subdivisions = Subdivision::all();

        return (new View)->render('site.search', ["rooms" => $rooms, "subdivisions" => $subdivisions]);
    }
}
