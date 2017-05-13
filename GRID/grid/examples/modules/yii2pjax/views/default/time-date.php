<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $response string */
$this->title = 'Yii2 и Pjax: Пример с двумя ссылками и одним объектом';
$this->params['breadcrumbs'][] = ['label' => 'Yii2 и Pjax', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <?php Pjax::begin(); ?>
    <?= Html::a("Показать дату", ['/yii2pjax/date'], ['class' => 'btn btn-lg btn-success']) ?>
    <?= Html::a("Показать время", ['/yii2pjax/time'], ['class' => 'btn btn-lg btn-primary']) ?>
    <h1>Сейчас: <?= $response ?></h1>
    <?php Pjax::end(); ?>



    <hr />
    <p>Представление views\site\time-date.php:<br>
        <pre style="background:rgba(238,238,238,0.92);color:#000">&lt;?php <span style="color:#33f;font-weight:700">Pjax</span><span style="color:#00f">::</span>begin(); ?>
&lt;?= <span style="color:#33f;font-weight:700">Html</span><span style="color:#00f">::</span>a(<span style="color:#093">"Показать дату"</span>, [<span style="color:#093">'site/date'</span>], [<span style="color:#093">'class'</span> <span style="color:#00f">=></span> <span style="color:#093">'btn btn-lg btn-success'</span>]) ?>
&lt;?= <span style="color:#33f;font-weight:700">Html</span><span style="color:#00f">::</span>a(<span style="color:#093">"Показать время"</span>, [<span style="color:#093">'site/time'</span>], [<span style="color:#093">'class'</span> <span style="color:#00f">=></span> <span style="color:#093">'btn btn-lg btn-primary'</span>]) ?>
&lt;h1>It's: &lt;?= $response ?>&lt;/h1>
&lt;?php <span style="color:#33f;font-weight:700">Pjax</span><span style="color:#00f">::</span>end(); ?>
</pre>
    <br>Контроллер controllers\SiteController.php:<br>
    <pre style="background:rgba(238,238,238,0.92);color:#000">
<span style="font-weight:700">public </span><span style="font-weight:700">function</span> <span style="color:#ff8000">actionTime</span>()
{
<span style="color:#00f">    return</span> $this<span style="color:#00f">-></span>render(<span style="color:#093">'time-date'</span>, [<span style="color:#093">'response'</span> <span style="color:#00f">=></span> <span style="color:#33f;font-weight:700">date</span>(<span style="color:#093">'H:i:s'</span>)]);
}

<span style="font-weight:700">public </span><span style="font-weight:700">function</span> <span style="color:#ff8000">actionDate</span>()
{
<span style="color:#00f">    return</span> $this<span style="color:#00f">-></span>render(<span style="color:#093">'time-date'</span>, [<span style="color:#093">'response'</span> <span style="color:#00f">=></span> <span style="color:#33f;font-weight:700">date</span>(<span style="color:#093">'d.m.Y'</span>)]);
}
</pre>


</div>

