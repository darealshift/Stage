<?php
include_once("html.php");

Form::AddSetting('Method','POST');
Form::AddSetting('Action','Contact.php');
Form::AddElement('label','Naam','','','');
Form::AddElement('text','','Voor en achternaam','naam','naam',true);
Form::AddElement('label','E-mailadress','','','');
Form::AddElement('email','','test@test.test','email','email',true);
Form::AddElement('label','telefoonnummer','','','');
Form::AddElement('text','','+31','tel','tel');
Form::AddElement('label','opmerking','','','');
Form::AddElement('textarea','','','opmerking','opmerking',true);
Form::AddElement('submit','submit','','','btn btn-success');
Form::$legend='Contactformulier';
Form::Show();

?>