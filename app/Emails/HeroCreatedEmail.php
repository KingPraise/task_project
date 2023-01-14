<?php

namespace App\Emails;

use App\Models\Hero;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HeroCreatedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $hero;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Hero $hero)
    {
        $this->hero = $hero;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.hero-created')
            ->subject("New Hero Created: {$this->hero->name}");
    }
}
