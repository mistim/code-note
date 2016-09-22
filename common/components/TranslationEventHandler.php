<?php

namespace common\components;

use common\models\SourceMessage;
use common\models\Message;
use yii\i18n\MissingTranslationEvent;
use Yii;
use yii\db\Query;

/**
 * Class TranslationEventHandler
 * @package common\components
 */
class TranslationEventHandler
{
	/**
	 * @param MissingTranslationEvent $event
	 * @return MissingTranslationEvent
	 */
	public static function handleMissingTranslation(MissingTranslationEvent $event)
	{
		if (self::checkNeeded($event->category))
		{
			$attributes = ['category' => $event->category, 'message' => $event->message];

			$query = (new Query())
				->select('id, category, message')
				->from(SourceMessage::tableName())
				->where('category = :category AND BINARY message = :message');

			$data = $query->createCommand()
				->bindValue('category', $event->category)
				->bindValue('message', $event->message)
				->queryOne();

			if (!$data )
			{
				$model = new SourceMessage();
				$model->attributes = $attributes;

				if ( $model->save() ) {

					$attributes = ['id' => $model->id, 'language' => $event->language];
					self::saveMessage($attributes, $event);

					if ($event->category === 'app')
					{
						foreach (Yii::$app->urlManager->languages as $language => $languageName)
						{
							$attributes = ['id' => $model->id, 'language' => $language];
							self::saveMessage($attributes, $event);
						}
					}
				}
			}
			else
			{
				/** @var Message $model */
				if (($model = Message::find()->where('id=:id AND language=:language', [':id'=>$data['id'], ':language'=>$event->language])) === null)
				{
					$attributes = ['id' => $data['id'], 'language' => $event->language];
					self::saveMessage($attributes, $event);
				}

				if ($event->category === 'app')
				{
					foreach (Yii::$app->urlManager->languages as $language => $languageName)
					{
						$attributes = ['id' => $data['id'], 'language' => $language];
						self::saveMessage($attributes, $event);
					}
				}
			}

			return $event;
		}

	}

	/**
	 * @param $attributes
	 * @param MissingTranslationEvent $event
	 * @return bool
	 */
	protected static function saveMessage($attributes, MissingTranslationEvent $event)
	{
		/** @var Message $message */
		$message = Message::findOne([
			'language' => $attributes['language'],
			'id' => $attributes['id']
		]);

		if (!$message)
		{
			$message = new Message();
		}

		$message->attributes = $attributes;
		$message->translation = $event->message;

		return $message->save();
	}

	/**
	 * @param $category
	 * @return bool
	 */
	protected static function checkNeeded($category)
	{
		if ($category === 'admin' && Yii::$app->language === 'ru')
		{
			return true;
		}
		elseif ($category === 'app' && isset(Yii::$app->urlManager->languages) && in_array(Yii::$app->language, array_keys(Yii::$app->urlManager->languages), true))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}