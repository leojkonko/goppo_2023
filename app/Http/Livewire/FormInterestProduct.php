<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Ellite\Contact\Models\SiteEmail;
use App\Services\SiteService;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactEmail;
use Ellite\Contact\Services\ContactService;
use Ellite\Products\Models\Product;

class FormInterestProduct extends Component
{
    public $name;
    public $email;
    public $phone;
    public $message;
    public $accept;

    public $product;
    public $product_id;

	protected $rules = [
        'name' => 'required|string',
        'email' => 'required|string|email',
        'message' => 'required|string',
        'accept' => 'required|string',
        'product' => 'required',
    ];
	
	protected $messages = [
		'name.required' => 'Digite seu nome.',
		'email.required' => 'Digite seu e-mail.',
		'email.email' => 'O e-mail inserido não é válido.',
		'message.required' => 'Digite sua mensagem.',
		'accept.required' => 'Você deve aceitar a política de privacidade.',
		'product.required' => 'Erro.',
	];

    public function render()
    {
        return view('livewire.form-interest-product');
    }

    public function send(SiteService $site, ContactService $contact)
    {
        $this->product = Product::whereId($this->product_id)->first();

        $this->validate();

        $message = new SiteEmail();

        $message->name = $this->name;
        $message->email = $this->email;
        $message->phone = $this->phone;
        $message->message = $this->message;

        $message->form_name = 'Interesse de produto';
        $message->form_slug = 'product_interest';

        $message->entity_name = $this->product->name;
        $message->entity_id = $this->product->id;

        $message->save();

        $site_name = env('APP_NAME');

        $contact_email = new ContactEmail(
			text: "O cliente {$this->name} entrou em contato através do formulário de interesse de produto da $site_name.",
			items: [
				'Produto' => $this->product->name,
				'Nome' => $this->name,
				'E-mail' => $this->email,
				'Telefone' => $this->phone,
				'Mensagem' => $this->message,
			],
		);
        $contact_email->subject("Interesse de produto pelo Site - $site_name");

        try {
            $site->configEmail();
            Mail::to($contact->getEmailsDestiny('form-destiny-product'))->send($contact_email);

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

        $product = $this->product;

        $this->reset();
		
        $this->product_id = $product->id;

		session()->flash('success', 'Recebemos sua mensagem. Obrigado por entrar em contato!');
    }
}
