<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Carbon\Carbon;

use App\Poem;

class Rss extends Model implements Feedable
{
    public function toFeedItem()
    {
        return FeedItem::create()
            ->id($this->id)
            ->title($this->title)
            ->summary($this->meaning)
            ->updated($this->updated_at)
            ->link($this->link)
            ->author($this->user->name);
    }

    public static function newPoems(){

        $poems = Poem::select('poetry.id as poem_id, title, meaning, poetry.updated_at as updated, users.name as author')
                ->join('users', 'poetry.user_id','=', 'users.id')
                ->where('poetry.published', true)
                ->where('users.banned', false)
                ->where('users.disabled', false)
                ->get();

        $poemsRss = $poems->map(function($p, $k){
            return FeedItem::create()
                    ->id((string)$p->poem_id)
                    ->title((string)$p->title)
                    ->summary((string)$p->meaning)
                    ->updated(new Carbon($p->updated))
                    ->link( route('poem-individual', ['id' => $p->poem_id ]) )
                    ->author((string)$p->author);
        });

        return $poemsRss;
    }
}
