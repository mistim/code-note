<?php

namespace frontend\controllers;

use frontend\components\yandex\ApiAuthMusic;
use frontend\components\yandex\YandexMusic;
use frontend\models\form\SearchForm;
use yii\web\Controller;
use Yii;

/**
 * Class SearchController
 * @package frontend\controllers
 */
class SearchController extends Controller
{
	public $config;

	/**
	 * @return string
	 */
	public function actionIndex()
	{
		$model = new SearchForm();

		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			return $this->redirect('');
		} else {
			return $this->render('index', [
				'model' => $model
			]);
		}
	}

	public function actionTest()
	{
		/*$ya = YandexMusic::getInstance();
		$data = $ya->search('світло і тінь', 'album');
		//$data = $ya->search('Lama', 'artist');

		echo '<pre>'; var_dump($data);*/

		$horses = [];
		$horses_ = [];
		$horses__ = [];
		$wins = [];
		$wins_ = [];
		$cnt = 0;
		$max = 5;
		$groups = [
			1 => 'A',
			2 => 'B',
			3 => 'C',
			4 => 'D',
			5 => 'E',
		];
		$finish = [];
		$win_horse = [];

		for ($i = 1; $i <= 25; $i++) {
			$horses[$i] = (float) rand(20000, 30000) / 1000;
		}

		$a = 1;

		foreach ($horses as $k => $v) {
			$horses_[$groups[$a]][$k] = $v;
			$horses__[$groups[$a]][$k] = $v;
			$k % 5 === 0 && $a++;
		}


		// первый раунд
		foreach ($groups as $group) {
			//$group_ = $horses[$group];
			arsort($horses__[$group]);
			$wins[++$cnt][$group] = $horses__[$group];
		}

		foreach ($horses__ as $group) {
			$g = 1;
			foreach ($group as $k => $v) {
				$g === 1 && $finish[1][$k] = $v;
				$g === 2 && $finish[2][$k] = $v;
				$g === 3 && $finish[3][$k] = $v;
				$g++;
			}
		}

		arsort($finish[1]);
		arsort($finish[2]);
		arsort($finish[3]);

		$wins_[count($wins) + 1] = $finish[1];
		$wins_[count($wins) + 2] = $finish[2];
		$wins_[count($wins) + 3] = $finish[3];

		/*$w = 1;
		foreach ($wins_[count($wins) + 1] as $k => $v) {
			$w === 1 && $win_horse['1е место'][$k] = $v;
			$w === 2 && $finish[5][$k] = $v;
			$w === 3 && $finish[5][$k] = $v;
			$w++;
		}

		array_pop($finish[2]);
		array_pop($finish[2]);
		array_pop($finish[2]);
		array_pop($finish[3]);
		array_pop($finish[3]);
		array_pop($finish[3]);
		array_pop($finish[3]);

		foreach ($finish[2] as $k => $v) {
			$finish[5][$k] = $v;
		}
		foreach ($finish[3] as $k => $v) {
			$finish[5][$k] = $v;
		}

		arsort($finish[5]);
		$wins_[count($wins) + 2] = $finish[5];

		$w = 1;
		foreach ($wins_[count($wins) + 2] as $k => $v) {
			$w === 1 && $win_horse['2е место'][$k] = $v;
			$w === 2 && $win_horse['3е место'][$k] = $v;
			$w++;
		}*/


		$w = 1;
		foreach ($wins_[count($wins) + 1] as $k => $v) {
			$w === 1 && $win_horse['1е место'][$k] = $v;
			$w === 2 && $finish[4][$k] = $v;
			$w === 3 && $finish[4][$k] = $v;
			$w++;
		}

		$w = 1;
		foreach ($wins_[count($wins) + 2] as $k => $v) {
			$w === 1 && $finish[4][$k] = $v;
			$w === 2 && $finish[4][$k] = $v;
			$w++;
		}

		$w = 1;
		foreach ($wins_[count($wins) + 3] as $k => $v) {
			$w === 1 && $finish[4][$k] = $v;
			$w++;
		}

		arsort($finish[4]);
		$wins_[count($wins) + 4] = $finish[4];

		$w = 1;
		foreach ($wins_[count($wins) + 4] as $k => $v) {
			$w === 1 && $win_horse['2е место'][$k] = $v;
			$w === 2 && $win_horse['3е место'][$k] = $v;
			$w++;
		}

		echo '[лошадь] = скорость (к примеру средняя скорость лошади, км)';
		echo '<br/>Все лошади';
		echo '<pre>'; print_r($horses); echo '</pre>';
		echo '<br/>Делим на группы (A, B, C, D, E) по 5 лошадей в каждой';
		echo '<pre>'; print_r($horses_); echo '</pre>';
		echo '<br/>Проводим 5 забегов, по 1 на группу';
		echo '<pre>'; print_r($wins); echo '</pre>';
		echo '<br/>Забег 6 - среди первых мест в группах, победитель занимает первое место';
		echo '<br/>Забег 7 - среди вторых мест в группах';
		echo '<br/>Забег 8 - среди третьих мест в группах';
		echo '<br/>Забег 9 - определяем 2е и 3е места, участвуют 2е и 3е места 6го забега и 1е и 2е места 7го забега и 1е место 8 забега';
		echo '<pre>'; print_r($wins_); echo '</pre>';
		echo '<br/>Победители';
		echo '<pre>'; print_r($win_horse); echo '</pre>';
	}
}