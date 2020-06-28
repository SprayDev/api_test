<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\member;
use App\party;
use App\Mail\createUserNotify;


class MemberController extends Controller
{
    public function createAPIUser(){
        return User::forceCreate([
            'name' => 'Api',
            'email' => 'api@mail.ru',
            'password' => Hash::make('api123'),
            'api_token' => Str::random(80),
        ]);
    }

    public function create($params){
        $array = explode('|', $params);
        if (party::find($array[3]))
        {
            $user = Member::where('email', $array[2])->first();
            if ($user)
            {
                $error = [
                    'error' => 'Участник с такой почтой уже существует'
                ];
                return json_encode($error, JSON_UNESCAPED_UNICODE);
            }
            $member = new member();
            $member->first_name = $array[0];
            $member->surname = $array[1];
            $member->email = $array[2];
            $member->party_id = $array[3];
            $member->save();
            Mail::to('danil-kravtsiv@mail.ru')->queue(new createUserNotify($array[0], $array[2]));
            return json_encode($member, JSON_UNESCAPED_UNICODE);
        }
        else
        {
            $error = [
                'error' => 'Данного мероприятия не существует'
            ];
            return json_encode($error, JSON_UNESCAPED_UNICODE);
        }
    }

    public function delete($id){
        if ($member = member::find($id))
        {
            $member->delete();
            return json_encode(['status' => 'Успешно удален'], JSON_UNESCAPED_UNICODE);
        }
        else
        {
            $error = [
                'error' => 'Пользователя с таким ид не существует'
            ];
            return json_encode($error, JSON_UNESCAPED_UNICODE);
        }
    }


    public function get($id){
        if ($member = member::find($id))
        {
            return 1;
            return json_encode($member, JSON_UNESCAPED_UNICODE);
        }
        else
        {
            $error = [
                'error' => 'Пользователя с таким ид не существует'
            ];
            return json_encode($error, JSON_UNESCAPED_UNICODE);
        }
    }

    public function getParty($id){
        if (Party::find($id))
        {
            $members = member::whereParty_id($id)->get();
            return json_encode($members, JSON_UNESCAPED_UNICODE);
        }
        else
        {
            $error = [
                'error' => 'Данного мероприятия не существует'
            ];
            return json_encode($error, JSON_UNESCAPED_UNICODE);
        }
    }


    public function update($id, $params){
        $array = explode('|', $params);
        if ($member = member::find($id))
        {
            if ($array[0])
                $member->first_name = $array[0];
            if ($array[1])
                $member->surname = $array[1];
            if ($array[2])
                $member->email = $array[2];
            if ($array[3])
                $member->party_id = $array[3];
            $member->save();
            return json_encode($member, JSON_UNESCAPED_UNICODE);
        }
        else
        {
            $error = [
                'error' => 'Данного мероприятия не существует'
            ];
            return json_encode($error, JSON_UNESCAPED_UNICODE);
        }
    }
}
