<?php
// app/components/Request.php
namespace common\components;

use yii\base\Component;

class Operator extends Component
{
	/* Convert hexdec color string to rgb(a) string */
	public function hex2rgba($color, $opacity = false) {

		$default = 'rgb(0,0,0)';

		//Return default if no color provided
		if(empty($color))
		        return $default; 

		//Sanitize $color if "#" is provided 
		if ($color[0] == '#' ) {
			$color = substr( $color, 1 );
		}

		$color = rtrim($color,';');

		//Check if color has 6 or 3 characters and get values
		if (strlen($color) == 6) {
			$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
		} elseif ( strlen( $color ) == 3 ) {
			$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
		} else {
			return $default;
		}

		//Convert hexadec to rgb
		$rgb =  array_map('hexdec', $hex);

		//Check if opacity is set(rgba or rgb)
		if($opacity){
			if(abs($opacity) > 1)
				$opacity = 1.0;
			$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
		} else {
			$output = 'rgb('.implode(",",$rgb).')';
		}
		//Return rgb(a) color string
		return $output;
	}

	/* Za prva slova č, ć, š, đ, ž */
	public function sentenceCase($string)
	{
	    $strlen = mb_strlen($string, 'UTF-8');
	    $firstChar = mb_substr($string, 0, 1, 'UTF-8');
	    $then = mb_substr($string, 1, $strlen - 1, 'UTF-8');
	    return mb_strtoupper($firstChar, 'UTF-8') . $then;
	}

	public function findCurrencyByCode($code)
    {
        if (($model = \frontend\models\CsCurrencies::find()->where('code="'.$code.'"')->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function price($price, $curr_1, $curr_2)
    {
        $curr_1 = $this->findCurrencyByCode($curr_1);
        $curr_2 = $this->findCurrencyByCode($curr_2);
        if($curr_1 and $curr_2){
            // konverzija cene u EUR
            $EUR_price = $price/$curr_1->rate;

            // tražena cena u izabranoj valuti
            return $EUR_price*$curr_2->rate;
        }
        return;   
    }
}