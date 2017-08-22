<?php

namespace PW\EvmeetBundle\Services;

use PW\EvmeetBundle\Entity\Article;

class PWLevelTranslate
{

	public function translate($level)
	{
		switch ($level) {
			case 1:
				return "4A";
				break;
			case 2:
				return "4B";
				break;
			case 3:
				return "4C";
				break;
			case 4:
				return "5A";
				break;
			case 5:
				return "5B";
				break;
			case 6:
				return "5C";
				break;
			case 7:
				return "6A";
				break;
			case 8:
				return "6B";
				break;
			case 9:
				return "6C";
				break;
			case 10:
				return "7A";
				break;
			case 11:
				return "7B";
				break;
			case 12:
				return "7C";
				break;
			case 13:
				return "8A";
				break;
		}
		
	}
}