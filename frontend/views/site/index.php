<?php

/* @var $this yii\web\View */

$this->title = 'Сервис Яндекс такси для водителей и пассажиров в Санкт-Петербурге — My Way';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Сервис для водителей и пассажиров Яндекс такси My Way — облегчение и улучшение работы в Яндекс такси. Регистрация водителей, работа в Яндекс такси Спб на своём или арендованном авто.',
], 'description');
$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'регистрация в Яндекс такси, работа в яндекс такси, присоединиться к работе в такси, сервис для яндекс такси, улучшение работы в такси, яндекс такси санкт-петербург',
], 'keywords');

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JqueryAsset;
use yii\widgets\MaskedInput;
use yii\widgets\Pjax;

$this->registerJsFile(Url::to(['/js/slide.js']),['depends' => [JqueryAsset::class]]);
?>
<wrapper id="main">
    <div id="dws-slider" class="carousel slide" data-ride="carousel">
        <!--Показатели-->
        <ol class="carousel-indicators">
            <?php $i = 0;?>
            <?php foreach ($slider as $one):?>
                <?php if ($i == 0):?>
                    <li data-target="#dws-slider" data-slide-to="<?= $i?>" class="active"></li>
                <?php else:?>
                    <li data-target="#dws-slider" data-slide-to="<?= $i?>"></li>
                <?endif;?>
                <?php $i++;?>
            <?php endforeach;?>
        </ol>

        <!--Обертка для слайдов-->
        <div class="carousel-inner" role="listbox">
            <?php $i = 0;?>
            <?php foreach ($slider as $one):?>
                <div class="item <?= $i == 0 ? 'active' : ''?>">
                    <img src="/images/slide/<?= $one['img']?>" alt="">
                    <div class="carousel-caption">
                        <h3 class="text-uppercase"><?= nl2br($one['name'])?></h3>
                        <p class="text-p-slide"><?= nl2br($one['text'])?></p>
                    </div>
                    <div class="bg-img"></div>
                </div>
                <?php $i++;?>
            <?php endforeach;?>
        </div>

        <!--Элементы управления-->
        <a class="left carousel-control" href="#dws-slider" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#dws-slider" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</wrapper>
<?php if(Yii::$app->user->isGuest): ?>
<div class="row scroll">
    <div class="col-md-6 pad-15 text-center registration"><a href="#registration-driver">Зарегистрироваться<br>как водитель</a></div>
    <div class="col-md-6 pad-15 text-center registration"><a href="#registration-passenger">Зарегистрироваться<br>как пассажир</a></div>
</div>
<?php endif;?>
<section id="about" class="abt-sec">
    <div class="container">
        <div class="row">
            <header class="header col-xs-12 text-center">
                <h2 class="heading text-uppercase"><?= nl2br($model_main[0]['name'])?></h2>
                <span class="border"><img src="/images/border.png" alt="image description" class="img-responsive"></span>
                <?php if (!empty($model_main[0]['text'])):?>
                    <p><?= nl2br($model_main[0]['text'])?></p>
                <?php endif;?>
            </header>
        </div>
    </div>
    <div class="bg-light border">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="list-unstyled service-list text-center">
                        <?php
                        $i = 0;
                        $j = 0;?>
                        <?php foreach ($o_nas as $one):?>
                            <?php if ($j == 0):?>
                                <div class="col-lg-12">
                            <?endif;?>
                            <div class="col-lg-4 pad-25">
                                <span class="icon icon-<?= $one['icon']?> clr5"></span>
                                <?php if (!empty($one['url'])):?>
                                <h3 class="heading2"><?= Html::a( nl2br($one['name']), ['/site/static', 'url' => $one['url']]); ?></h3>
                                <?php else: ?>
                                <h3 class="heading2"><?= nl2br($one['name'])?></h3>
                                <a data-toggle="collapse" data-parent="#collapse-group" href="#c<?= $i?>">Подробнее ...</a>
                                <div id="c<?= $i?>" class="panel-collapse collapse pad-top-15">
                                    <p><?= nl2br($one['text'])?></p>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php
                            $i++;
                            $j++;
                            ?>
                            <?php if ($j == 3):?>
                                </div>
                                <?php $j = 0;?>
                            <?endif;?>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="goal" class="abt-sec" data-scroll-index="2">
    <div class="container">
        <div class="row">
            <header class="header col-xs-12 text-center">
                <h2 class="heading text-uppercase"><?= nl2br($model_main[1]['name'])?></h2>
                <span class="border"><img src="/images/border.png" alt="image description" class="img-responsive"></span>
                <?php if (!empty($model_main[1]['text'])):?>
                    <p><?= nl2br($model_main[1]['text'])?></p>
                <?php endif;?>
            </header>
        </div>
    </div>
</section>
<div id="conditions">
    <section class="service-sec bg-light">
        <div class="row">
            <div class="col-lg-6 pad-0">
                <img src="/images/taxi-conditions.jpg" alt="image description" class="img-responsive">
            </div>
            <div class="col-lg-6 pad-0">
                <div class="col-lg-12 pad-50">
                    <header class="header">
                        <!--<span class="title text-uppercase">ready to services you</span>-->
                        <h2 class="heading text-uppercase"><?= nl2br($model_main[2]['name'])?></h2>
                        <span class="border2"><img src="/images/border2.png" alt="image description" class="img-responsive"></span>
                        <?php if (!empty($model_main[2]['text'])):?>
                            <p><?= nl2br($model_main[2]['text'])?></p>
                        <?php endif;?>
                    </header>
                    <ul class="list-unstyled service-category">
                        <?php foreach ($working_conditions as $one):?>
                            <li><span class="icon icon-<?= $one['icon']?>"></span> <?= nl2br($one['name'])?></li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 pad-0">
                <div class="col-lg-12 pad-50">
                    <header class="header">
                        <h2 class="heading text-uppercase"><?= nl2br($model_main[3]['name'])?></h2>
                        <span class="border2"><img src="/images/border2.png" alt="image description" class="img-responsive"></span>
                        <?php if (!empty($model_main[3]['text'])):?>
                            <p><?= nl2br($model_main[3]['text'])?></p>
                        <?php endif;?>
                    </header>
                    <ul class="list-unstyled service-category">
                        <?php foreach ($finance as $one):?>
                            <li><span class="icon icon-<?= $one['icon']?>"></span> <?= nl2br($one['name'])?></li>
                        <?php endforeach;?>
                    </ul>
                </div>

                <div class="col-lg-12 pad-50">
                    <header class="header">
                        <h2 class="heading text-uppercase"><?= nl2br($model_main[4]['name'])?></h2>
                        <span class="border2"><img src="/images/border2.png" alt="image description" class="img-responsive"></span>
                        <?php if (!empty($model_main[4]['text'])):?>
                            <p><?= nl2br($model_main[4]['text'])?></p>
                        <?php endif;?>
                    </header>
                    <ul class="list-unstyled service-category">
                        <?php foreach ($shutdown as $one):?>
                            <li><span class="icon icon-<?= $one['icon']?>"></span> <?= nl2br($one['name'])?></li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6 pad-0">
                <img src="/images/o-fin.jpg" alt="image description" class="img-responsive">
            </div>
        </div>

    </section>
    <div class="counter-holder overlay bg-full bac-taxi">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-lg-4">
                    <div class="col">
                        <span class="icon icon-User pull-left"></span>
                        <div class="pull-left">
                            <span class="counter">53</span>
                            <span class="title">Клиентов</span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-lg-4">
                    <div class="col">
                        <span class="icon icon-Car pull-left"></span>
                        <div class="pull-left">
                            <span class="counter">13</span>
                            <span class="title">Водителей</span>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-lg-4">
                    <div class="col">
                        <span class="icon icon-Cup pull-left"></span>
                        <div class="pull-left">
                            <span class="counter">768</span>
                            <span class="title">Заказов</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if(Yii::$app->user->isGuest): ?>
<div>
    <section class="service-sec bg-light" id="registration-driver">

        <div class="col-lg-6 pad-0">
            <img src="/images/taxi-driver-reg.jpg" alt="image description" class="img-responsive" style="">
        </div>
        <div class="col-lg-6 pad-25">

            <div class="col-lg-8 text-center">
                <header class="header">
                    <!--<span class="title text-uppercase">ready to services you</span>-->
                    <h2 class="heading text-uppercase">РЕГИСТРАЦИЯ В ТАКСОПАРКЕ MY WAY</h2>
                    <span class="border"><img src="images/border.png" alt="image description" class="img-responsive" style="margin-left:auto;margin-right:auto;"></span>
                    <p>Для работы в Яндекс такси водителем достаточно соответствовать требованиям предъявляемым к кандидатам и заполнить регистрационную форму</p>
                </header>

                <div class="newsletter-block">
                    <div class="newsletter-block newsletter-form">
                        <?php Pjax::begin(); ?>
                        <?php $form_driver_signup = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>
                        <div class="form-group">
                            <div class="col-lg-12 pad-0">
                                <?= $form_driver_signup->field($model_driver_signup, 'username')->label(false)
                                    ->widget(MaskedInput::class, [
                                        'mask' => '+9 (999) 999-99-99',
                                        'options' => [
                                            'class' => 'form-control lg-round',
                                            'placeholder' => 'Телефон',
                                            'required' => true,
                                        ]
                                    ])
                                ?>
                            </div>
                            <div class="col-lg-12 pad-0">
                                <?= $form_driver_signup->field($model_driver_signup, 'password')->passwordInput(['class' => 'form-control lg-round', 'placeholder' => 'Пароль', 'required' => true])->label(false) ?>
                            </div>

                            <div class="col-lg-12 pad-0">
                                <?= $form_driver_signup->field($model_driver_signup, 'checkPark')->checkbox() ?>
                            </div>

                            <div class="col-lg-12 pad-0">
                                <?= $form_driver_signup->field($model_driver_signup, 'checkPolicy')->checkbox() ?>
                            </div>
                        </div>
                        <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn-primary lg-round text-center', 'style' => 'font-size: 14px;', 'name' => 'reg-button']) ?>
                        <?php ActiveForm::end(); ?>
                        <?php Pjax::end(); ?>
                    </div>
                    <p>Оператор в течение 2х часов проведет проверку документов и при положительном решении пришлет sms о принятом решении с инструкцией как подключиться и начать зарабатывать деньги.</p>
                    <p class="pad-top-25">Если вы решили начать свою карьеру водителя такси в Санкт-Петербурге, напишите о себе на адрес migrant@mw.spb.ru и заполните анкету регистрации. В ответ получите инструкцию пошагово как приехать, как поселиться, как начать работу в первую же неделю по прибытию.</p>

                </div>
            </div>
        </div>
    </section>

    <!-- service sec of the page -->
    <section class="service-sec bg-light" id="registration-passenger">

        <div class="col-lg-6 pad-25">

            <div class="col-lg-8 text-center pull-right">
                <header class="header">
                    <h2 class="heading text-uppercase">РЕГИСТРАЦИЯ ПАССАЖИРА</h2>
                    <span class="border"><img src="images/border.png" alt="image description" class="img-responsive" style="margin-left:auto;margin-right:auto;"></span>
                    <p>Для входа в личный кабинет ведите номер телефона и пароль</p>
                </header>

                <div class="newsletter-block">
                    <div class="newsletter-block newsletter-form">
                        <?php Pjax::begin(); ?>
                        <?php $form_passenger_signup = ActiveForm::begin(['options' => ['data-pjax' => true]]); ?>
                        <div class="form-group">
                            <div class="col-lg-12 pad-0">
                                <?= $form_passenger_signup->field($model_passenger_signup, 'username')->label(false)
                                    ->widget(MaskedInput::class, [
                                        'mask' => '+9 (999) 999-99-99',
                                        'options' => [
                                            'class' => 'form-control lg-round',
                                            'placeholder' => 'Телефон',
                                            'required' => true,
                                        ]
                                    ])
                                ?>
                            </div>
                            <div class="col-lg-12 pad-0">
                                <?= $form_passenger_signup->field($model_passenger_signup, 'password')->passwordInput(['class' => 'form-control lg-round', 'placeholder' => 'Пароль', 'required' => true])->label(false) ?>
                            </div>
                            <div class="col-lg-12 pad-0">
                                <?= $form_passenger_signup->field($model_passenger_signup, 'phone_driver')->label(false)
                                    ->widget(MaskedInput::class, [
                                        'mask' => '+9 (999) 999-99-99',
                                        'options' => [
                                            'class' => 'form-control lg-round',
                                            'placeholder' => 'Телефон водителя',
                                        ]
                                    ])
                                ?>
                            </div>
                            <div class="col-lg-12 pad-0">
                                <?= $form_passenger_signup->field($model_passenger_signup, 'checkPolicy')->checkbox() ?>
                            </div>
                        </div>
                        <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn-primary lg-round text-center', 'style' => 'font-size: 14px;', 'name' => 'reg-button']) ?>
                        <?php ActiveForm::end(); ?>
                        <?php Pjax::end(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 pad-0">
            <img src="/images/taxi-passenger-reg.jpg" alt="image description" class="img-responsive" style="">
        </div>

    </section>
</div>
<?php endif;?>

<!-- testimonail sec of the page -->
<section class="testimonail-sec bg-full" style="background-image: url(/images/img08.jpg);" id="recall">
    <div class="container">
        <div class="row">
            <header class="header col-xs-12 text-center">
                <h2 class="heading text-uppercase"><?= nl2br($model_main[5]['name'])?></h2>
                <span class="border"><img src="/images/border.png" alt="image description" class="img-responsive"></span>
                <?php if (!empty($model_main[5]['text'])):?>
                    <p><?= nl2br($model_main[5]['text'])?></p>
                <?php endif;?>
            </header>
        </div>
        <div class="row">
            <div class="col-xs-12">

                <div id="command" class="scrollto clearfix text-center">

                    <div class="row clearfix">

                        <div class="slider text-left">
                            <div class="slider__wrapper">
                                <div class="slider__item testimonial classic">
                                    <div class="text-slide">
                                        <p>Спасибо вам за аккуратное вождение и тишину в салоне во время моей поездки в аэропорт Санкт-Петербурга! Я недавно установил приложение Яндекс такси и доволен что вы в числе первых произвели на меня впечатление. Так держать!</p>
                                        <p class="pad-top-15">(переведено на русский язык)</p>
                                    </div>
                                    <div class="pad-top-15 slide-one">
                                        <div>
                                            <a href="#x"><img src="/images/reviews/3.jpg" alt="Image" class="img-responsive"></a>
                                        </div>
                                        <div class="pad-15">
                                            <p><b>Mohamed Youssef</b></p>
                                            <p>HR Manager</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="slider__item testimonial classic">
                                    <div class="text-slide">
                                        <p>Отличный сервис за такие разумные деньги! Шкода Октавия достаточно комфортная и чистая машина с аккуратным водителем. Благодарю. Надеюсь он оценит мое спасибо в виде чаевых!</p>
                                        <p class="pad-top-15"></p>
                                    </div>
                                    <div class="pad-top-15 slide-one">
                                        <div>
                                            <a href="#x"><img src="/images/reviews/1.jpg" alt="Image" class="img-responsive"></a>
                                        </div>
                                        <div class="pad-15">
                                            <p><b>Pardavimu Vadovas</b></p>
                                            <p>Sales manager</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="slider__item testimonial classic">
                                    <div class="text-slide">
                                        <p>Мы всей семьей проехали с Игорем полтора часа и хотим сказать спасибо и за конфеты, которые оценили наши дети и за воду в дверях и за тихую спокойную музыку.
                                            <br>Приедем в Санкт-Петербург еще раз, непременно обратимся к вам снова!</p>
                                        <p class="pad-top-15"></p>
                                    </div>
                                    <div class="pad-top-15 slide-one">
                                        <div>
                                            <a href="#x"><img src="/images/reviews/2.jpg" alt="Image" class="img-responsive"></a>
                                        </div>
                                        <div class="pad-15">
                                            <p><b>Семья Смирновых</b></p>
                                            <p>Воронеж</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="slider__item testimonial classic">
                                    <div class="text-slide">
                                        <p>Мы с женой ведем бизнес Санкт-Петербурге, перетягиваем мебель и часто обращаемся за вашими услугами. Своей машины у нас нет. Поэтому вызываем такси My Way. Пунктуальность это ваш конек. Разумные цены тоже!</p>
                                        <p class="pad-top-15"></p>
                                    </div>
                                    <div class="pad-top-15 slide-one">
                                        <div>
                                            <a href="#x"><img src="/images/reviews/4.jpg" alt="Image" class="img-responsive"></a>
                                        </div>
                                        <div class="pad-15">
                                            <p><b>Марат и Елена</b></p>
                                            <p>ООО Марлен</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <a class="slider__control slider__control_left" role="button"></a>
                            <a class="slider__control slider__control_right slider__control_show" role="button"></a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>
<!-- testimonail sec of the page end -->
