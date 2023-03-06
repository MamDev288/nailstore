<?php

namespace backend\components;

use kartik\time\TimePicker;

class TimePickerWidget
{
    public static function TimePicker($form, $model, $field){
        return $form->field($model, $field)->widget(TimePicker::classname(),[
            'pluginOptions' => [
                'showSeconds'=>true,
                'showMeridian' => false,
                'minuteStep' => 1,
                'secondStep' => 10,
            ],
            'addonOptions' => [
                'asButton' => true,
                'buttonOptions' => ['class' => 'time-picker btn btn-info']
            ],
        ]);
    }
}