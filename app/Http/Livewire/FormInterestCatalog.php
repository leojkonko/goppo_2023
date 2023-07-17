<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Ellite\Contact\Models\SiteEmail;
use App\Services\SiteService;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactEmail;
use Ellite\Contact\Services\ContactService;

class FormInterestCatalog extends Component
{
    public $name;
    public $email;
    public $phone;
    public $address;
    public $accept;

	protected $rules = [
        'name' => 'required|string',
        'email' => 'required|string|email',
        'address' => 'required|string',
        'accept' => 'required|string',
    ];
	
	protected $messages = [
		'name.required' => 'Digite seu nome.',
		'email.required' => 'Digite seu e-mail.',
		'email.email' => 'O e-mail inserido não é válido.',
		'address.required' => 'Digite seu endereço.',
		'accept.required' => 'Você deve aceitar a política de privacidade.',
	];
	
    public function render()
    {
        return view('livewire.form-interest-catalog');
    }
    
    public function send(SiteService $site, ContactService $contact)
    {
        $this->validate();

        $message = new SiteEmail();

        $message->name = $this->name;
        $message->email = $this->email;
        $message->phone = $this->phone;
        $message->message = $this->address;

        $message->form_name = 'Interesse de catálogo';
        $message->form_slug = 'catalog_interest';

        $message->save();

        $site_name = env('APP_NAME');

        $contact_email = new ContactEmail(
			text: "O cliente {$this->name} solicitou a versão física do catálogo através do site da $site_name.",
			items: [
				'Nome' => $this->name,
				'E-mail' => $this->email,
				'Telefone' => $this->phone,
				'Endereço' => $this->address,
			],
		);
        $contact_email->subject("Interesse de catálogo pelo Site - $site_name");

        try {
            $site->configEmail();
            Mail::to($contact->getEmailsDestiny('form-destiny-catalog'))->send($contact_email);

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
