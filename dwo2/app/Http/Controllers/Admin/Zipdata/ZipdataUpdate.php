<?php

namespace App\Http\Controllers\Admin\Zipdata;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ZipdataUpdate extends Controller
{
public $timeout = 600;

    public function update_result(Request $request)
    {
		$storagePath = storage_path('app/public');

		$dataFile    = config('dwo.ZIPUPDATE_DATA_FILE');
		$fileName    = config('dwo.ZIPUPDATE_FILE_NAME');
		$upoloadFile = config('dwo.ZIPUPDATE_UPLOAD_FILE');

		$tmpDir = config('dwo.ZIPUPDATE_TMP_DIR');

		$dlUrl = config('dwo.ZIPUPDATE_DL_URL');

		$controlFile = config('dwo.ZIPUPDATE_CONTROL_FILE');
		$logFile     = config('dwo.ZIPUPDATE_LOG_FILE');
		$badFile     = config('dwo.ZIPUPDATE_BAD_FILE');

		$preFile     =  $storagePath . '/' . config('dwo.ZIPUPDATE_LASTTIME_DATA_FILE');
		$prePreFile  =  $storagePath . '/' . config('dwo.ZIPUPDATE_B_LASTTIME_DATA_FILE');

		$dbUser = config('dwo.DB_USER');
		$dbPass = config('dwo.DB_PASS');
		$dbName = config('dwo.DB_NAME');

		$oracle_bin = config('dwo.ORACLE_BIN');
		$oracle_home = config('dwo.ORACLE_HOME');
		$tns_admin = config('dwo.TNS_ADMIN');
		$tns_name = config('dwo.TNS_NAME');
		$user_bin = config('dwo.USER_BIN');
		
		putenv('PATH=' . $oracle_bin . ':' .  $user_bin);
		putenv('LD_LIBRARY_PATH=' . $oracle_home);
		putenv('TNS_ADMIN=' . $tns_admin);

    	@unlink($storagePath . '/' . $dataFile);
    	@unlink($storagePath . '/' . $upoloadFile);

    	if (!empty($request->file('zipdata_file')) ) {
    		$request->file('zipdata_file')->storeAs($tmpDir, $fileName, 'public');
    	} else {
    	
    		$wget_cmd = "wget -P " . $storagePath . '/' . $tmpDir . " --no-check-certificate " . $dlUrl;
//    		$wget_cmd .= "  2>&1 ";

    		$msg = exec($wget_cmd, $res, $stat);
//dd($wget_cmd);

    		if ($stat !== 0) {
   				return redirect('admin/zipdata/update/form')->with('flash_message', '郵便番号データがダウンロードできませんでした。');
    		}
    		
    	}
    	
    	$zip = new \ZipArchive();

    	if ($zip->open( $storagePath . '/' . $upoloadFile ) === TRUE) {
    		$zip->extractTo(  $storagePath . '/' . $tmpDir );
    		$zip->close();
    	} else {
   			return redirect('admin/zipdata/update/form')->with('flash_message', 'ZIP形式の圧縮ファイルをアップロードしてください。');
    	}

		$stat = 0;

    	$sqlldr_cmd = "sqlldr " . $dbUser . "/" . $dbPass . "@" .  $tns_name .
    			" CONTROL=" . $storagePath . '/' . $controlFile . 
    			" DATA="    . $storagePath . '/' . $dataFile .
    			" LOG="     . $storagePath . '/' . $logFile .
    			" BAD="     . $storagePath . '/' . $badFile;
//    	$sqlldr_cmd .= "  2>&1 ";
//dd($sqlldr_cmd);
    	$msg = exec($sqlldr_cmd, $res, $stat);
    	// 非同期でやるなら
    	// $fp = popen('start ' . $cmd, 'r');
    	// pclose($fp);

    	if ($stat !== 0) {
   			return redirect('admin/zipdata/update/form')->with('flash_message', '更新処理中にエラーが発生しました。');
    	} else {
    	
    		if (file_exists($prePreFile)) {
    			@unlink($prePreFile);
    		}
    		@rename($preFile, $prePreFile);
    		
    		if (file_exists($preFile)) {
    			@unlink($preFile);
    		}
    		rename( $storagePath . '/' . $upoloadFile, $preFile);
    		
    		$msg = "郵便番号辞書データ更新が完了しました。";
    		
    	}
    	
    	@unlink( $storagePath . '/' . $dataFile);
    	@unlink( $storagePath . '/' . $upoloadFile);

		return view('admin.zipdata.updateResult',compact(
			'msg',
		));
    }
    
}
