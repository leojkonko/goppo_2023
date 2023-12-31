<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Ellite\Contact\Models\SiteEmail;
use App\Services\SiteService;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactEmail;
use Ellite\Contact\Services\ContactService;

class FormContact extends Component
{
    public $name;
    public $email;
    public $phone;
    public $city;
    public $message;
    public $accept;

	protected $rules = [
        'name' => 'required|string',
        'email' => 'required|string|email',
        'message' => 'required|string',
        'phone' => 'required|string',
        'accept' => 'required|string',
    ];
	
	protected $messages = [
		'name.required' => 'Digite seu nome.',
		'email.required' => 'Digite seu e-mail.',
		'phone.required' => 'Digite seu telefone.',
		'city.required' => 'Digite sua cidade.',
		'email.email' => 'O e-mail inserido não é válido.',
		'message.required' => 'Digite sua mensagem.',
		'accept.required' => 'Você deve aceitar a política de privacidade.',
	];
	
    public function render()
    {
        return view('livewire.form-contact');
    }

    public function send(SiteService $site, ContactService $contact)
    {
        $this->validate();

        $message = new SiteEmail();

        $message->name = $this->name;
        $message->email = $this->email;
        $message->phone = $this->phone;
        $message->city = $this->city;
        $message->message = $this->message;

        $message->form_name = 'Contato';
        $message->form_slug = 'contact';

        $message->save();

        $site_name = env('APP_NAME');

        $contact_email = new ContactEmail(
			text: "O cliente {$this->name} entrou em contato através do formulário de contato do site da $site_name.",
			items: [
				'Nome' => $this->name,
				'E-mail' => $this->email,
				'Telefone' => $this->phone,
				'Cidade' => $this->city,
				'Mensagem' => $this->message,
			],
		);
        $contact_email->subject("Contato pelo Site - $site_name");

        try {
            $site->configEmail();
            Mail::to($contact->getEmailsDestiny())->send($contact_email);

            $message->sent = 1;
            $message->save();
        }
        catch (Exception $e) {
            $message->debug = $e->getMessage();
            $message->save();

            if (env('APP_DEBUG')) {
                throw $e;
            }

            $this->addError('email', 'Falha ao enviar contato.');
			return;
        }

        $this->reset();
		
		session()->flash('success', 'Recebemos sua mensagem. Obrigado por entrar em contato!');
    }
}
