<?php

namespace app\modules\subscribe\component;

use yii\base\Component;
use app\modules\bookcatalog\models\Author;
use app\modules\subscribe\helpers\SmsPilotMessage;
use app\modules\subscribe\models\ModelSubscription;

class SubscriptionNotifier extends Component
{
    public static function notifySubscribersAboutNewBook(Author $author)
    {
        $userSubscribeBookAuthors = ModelSubscription::findAll([
            'entity' => get_class($author),
            'entity_id' => $author->id,
        ]);

        foreach ($userSubscribeBookAuthors as $userSubscribeBookAuthor) {
            $text = urlencode('У автора ' . $author->full_name . ' вышла новая книга!');
            SmsPilotMessage::send($userSubscribeBookAuthor->phone, $text);

            $userSubscribeBookAuthor->delete();
        }
    }
}
