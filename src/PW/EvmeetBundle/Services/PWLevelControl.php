<?php

namespace PW\EvmeetBundle\Services;

use PW\EvmeetBundle\Entity\Article;

class PWLevelControl
{

	public function isLevelCorrect(Article $article)
	{

		if ($article->getNiveauMin() > $article->getNiveauMax()){
			return false;
		}

		return true;
	}
}