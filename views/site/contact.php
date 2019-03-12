<<<<<<< HEAD
<div id="content-wrapper">
    <section id="contact" class="white">
        <div class="container">
            <div class="gap"></div>
            <div class="row">
                <div class="col-md-4 fade-up">
                    <h3>Kontakt ma'lumotlar</h3>
                    <p><span class="icon icon-home"></span>Time Square, New York<br/>
                        <span class="icon icon-phone"></span>+36 65984 405<br/>
                        <span class="icon icon-mobile"></span>+36 65984 405<br/>
                        <span class="icon icon-envelop"></span> <a href="#">email@infinityteam.com</a> <br/>
                        <span class="icon icon-twitter"></span> <a href="#">@infinityteam.com</a> <br/>
                        <span class="icon icon-facebook"></span> <a href="#">Infinity Agency</a> <br/>
                    </p>
                </div><!-- col -->

                <div class="col-md-8 fade-up">
                    <h3>Drop Us A Message</h3>
                    <br>
                    <br>
                    <div id="message"></div>
                    <form method="post" action="sendemail.php" id="contactform">
                        <input type="text" name="name" class="name" placeholder="Ism" required/>
                        <input type="tel" name="tel" class="name" placeholder="Telefon raqam" required>
                        <textarea name="comments" id="comments" placeholder="Murojaatning qisqacha tasnifi"></textarea>
                        <input class="btn btn-outlined btn-primary" type="submit" name="submit" value="Submit" />
                    </form>
                </div><!-- col -->
            </div><!-- row -->
            <div class="gap"></div>
        </div>
    </section>
=======
<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            Thank you for contacting us. We will respond to you as soon as possible.
        </div>

        <p>
            Note that if you turn on the Yii debugger, you should be able
            to view the mail message on the mail panel of the debugger.
            <?php if (Yii::$app->mailer->useFileTransport): ?>
                Because the application is in development mode, the email is not sent but saved as
                a file under <code><?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?></code>.
                Please configure the <code>useFileTransport</code> property of the <code>mail</code>
                application component to be false to enable email sending.
            <?php endif; ?>
        </p>

    <?php else: ?>

        <p>
            If you have business inquiries or other questions, please fill out the following form to contact us.
            Thank you.
        </p>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'email') ?>

                    <?= $form->field($model, 'subject') ?>

                    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    ]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    <?php endif; ?>
>>>>>>> origin/master
</div>
