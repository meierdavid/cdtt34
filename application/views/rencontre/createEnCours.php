
<div class="rencontre-form">

    <form>

        <?=
            $form->field($model, 'date')->widget(\yii\jui\DatePicker::classname(), [
                    //'language' => 'ru',
                    //'dateFormat' => 'yyyy-MM-dd',
            ])
            ?> 
        <div class="row">
            <div class="col-sm-6" style="background-color:yellow;">
                <h3>Gagnant</h3>
                <?= $form->field($modelJ1, 'nomJoueur')->textInput() ?>

                <?= $form->field($modelJ1, 'prenomJoueur')->textInput() ?>
            </div>
            <div class="col-sm-6" style="background-color:pink;">
                <h3>Perdant</h3>
                <div class="form-group field-joueur-nomjoueur " >
                    <label class="control-label" for="joueur2-nomjoueur">Nom Joueur</label>
                    <input type="text" id="joueur2-nomjoueur" class="form-control" name="Joueur2[nomJoueur]" aria-required="true">

                    <div class="help-block"></div>
                </div>    
                <div class="form-group field-joueur-prenomjoueur required">
                    <label class="control-label" for="joueur2-prenomjoueur">Prenom Joueur</label>
                    <input type="text" id="joueur2-prenomjoueur" class="form-control" name="Joueur2[prenomJoueur]" aria-required="true">

                    <div class="help-block"></div>
                </div>    </div>
        </div>
</div>

<div class="form-group">
    <center><?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Créer') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?></center>
</div>

</form>

