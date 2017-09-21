<?php

namespace Fresh\Estet\Repositories;

use Fresh\Estet\Contact;
use Fresh\Estet\Jobs\ContactUs;
use Validator;
use Config;

class ContactsRepository
{
    public function sendEmail($request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => ['required', 'string', 'between:4,64'],
            'subject' => ['required', 'string', 'between:5,64'],
            'text' => ['required', 'string', 'between:10,2048'],
            'capt' => 'required|size:5|alpha_num',
        ]);

        if ($validator->fails()) {
            return ['error' => $validator];
        }

        $data = $request->except('_token');
        if (session('captcha') != $data['capt']) {
            return ['error' => 'Пожалуйста введите код изображенный на картинке'];
        }

        $emails = $this->getEmails();
        foreach ($emails as $email) {
            $data['email_to'] = $email->email;
            dispatch(new ContactUs($data));
        }

        return ['status' => 'Ваше письмо отправлено'];
    }

    public function getEmails()
    {
        return Contact::select('email', 'id')->get();
    }

    public function addEmail($request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return ['error' => $validator];
        }

        try {
            Contact::updateOrCreate(['email' => $request->get('email')]);
        } catch (Exception $e) {
            \Log::info('Ошибка записи E-mail ', $e->getMessage());
            $error[] = ['email' => 'Ошибка записи E-mail'];
            return $error;
        }
        return ['status' => trans('admin.material_updated')];
    }
}