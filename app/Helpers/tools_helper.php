<?php
	
	use App\Models\BaseModel;
	
	/**
	 * Permite guardar un log en la base de datos
	 *
	 * @param int         $user     id de usuario
	 * @param int         $function id de función
	 * @param int         $code     Código de estatus
	 * @param string      $dataIn   JSON con los datos de entrada
	 * @param string|null $dataOut  JSON con los resultados
	 * @param string|NULL $env      Ambiente en el que se va a trabajar
	 *
	 * @return bool resultado
	 */
	function saveLog ( int $user, int $function, int $code, string $dataIn, ?string $dataOut = NULL, ?string $env = NULL ): bool {
		$model = new BaseModel();
		$data = [
			'user'     => $user,
			'function' => $function,
			'code'     => $code,
			'dataIn'   => $dataIn,
			'dataOut'  => $dataOut,
		];
		return $model->saveLogs ( $data, $env );
	}
	
	/**
	 * Permite crear un archivo
	 *
	 * @param string $logName Nombre del archivo log
	 * @param string $message Contenido del Log
	 *
	 * @return bool
	 */
	function createLog ( string $logName, string $message ): bool {
		$logDir = 'logs/';
		$logFile = fopen ( $logDir.$logName.'.log', 'a+' );
		if ( $logFile !== FALSE ) {
			$logMessage = '|'.date ( 'Y-m-d H:i:s' ).'|   '.$message."\r\n";
			fwrite ( $logFile, $logMessage );
			fclose ( $logFile );
			return TRUE;
		}
		return FALSE;
	}
	