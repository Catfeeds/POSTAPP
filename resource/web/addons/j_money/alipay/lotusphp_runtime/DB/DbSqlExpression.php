<?php  /*捷讯设计*/
class LtDbSqlExpression
{
	private $_expression;
	
	public function __construct($string)
	{
		$this->_expression = (string) $string;
	}
	
	public function __toString()
	{
		return (string) $this->_expression;
	}
}
