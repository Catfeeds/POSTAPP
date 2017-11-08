<?php  /*捷讯设计*/
class LtDbAdapterFactory
{
	public function getConnectionAdapter($connectionAdapterType)
	{
		$LtDbConnectionAdapter = "LtDbConnectionAdapter" . ucfirst($connectionAdapterType);
		return new $LtDbConnectionAdapter;
	}

	public function getSqlAdapter($sqlAdapterType)
	{
		$LtDbSqlAdapter = "LtDbSqlAdapter" . ucfirst($sqlAdapterType);
		return new $LtDbSqlAdapter;
	}
}