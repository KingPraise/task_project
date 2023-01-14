<?php

namespace App\Models;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Hero extends Model
{
    use HasFactory;
    public function weapons()
    {
        return $this->belongsToMany(Weapon::class, 'hero_weapons');
    }
    protected $dispatchesEvents = [
        'created' => HeroCreated::class,
    ];
    // ...

}
class HeroCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $hero;

    public function __construct(Hero $hero)
    {
        $this->hero = $hero;
    }
}
class SendHeroCreatedEmail
{
    public function handle(HeroCreated $event)
    {
        Mail::to('admin@test.com')->queue(new HeroCreatedEmail($event->hero));
    }
}
class HeroCreatedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $hero;

    public function __construct(Hero $hero)
    {
        $this->hero = $hero;
    }

    public function build()
    {
        return $this->view('emails.hero-created')
            ->subject("New Hero Created: {$this->hero->name}");
    }
}
