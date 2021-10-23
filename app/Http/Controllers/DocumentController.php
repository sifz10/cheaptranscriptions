<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Transcribejobs;
use App\Prices;
use App\Transcriptiontext;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function outputWord($transcribejobid)
    {
        $transcribejob = Transcribejobs::where('transactionid', '=', $transcribejobid)->first();
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
    
        $text = $section->addText("CheapTranscription.io Job #".$transcribejobid);
        $text = $section->addText($transcribejob->email);
	$text = $section->addText($transcribejob->updated_at);
        $text = $section->addText(PHP_EOL.PHP_EOL);
        
    $transcriptiontext = Transcriptiontext::where('transcribejobsid', '=', $transcribejob->id)->first();
    
    
        $transcribetext =  $transcriptiontext->transcriptiontext;
        $transcribetext = str_replace('<p>', '', $transcribetext);
        $transcribetext = str_replace('</p>', PHP_EOL.PHP_EOL, $transcribetext);
	$transcribetext = str_replace('spk_', "\r\nSpeaker ",$transcribetext);
	#$transcribetext = preg_replace(':', '\r\n',  $transcribetext); 

        #$$transcribetext = str_replace('spk_',PHP_EOL.PHP_EOL."Speaker ",$transcribetext);
	$textlines = explode("\n", $transcribetext);
	$textrun = $section->addTextRun();
	$textrun->addText(array_shift($textlines));

	foreach($textlines as $line) {
    		$textrun->addTextBreak();
    		// maybe twice if you want to seperate the text
    		// $textrun->addTextBreak(2);
    		$textrun->addText($line);
}
        #$text = $section->addText($transcribetext);
       
 $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $filename='CheapTranscription'.$transcribejobid.".docx";
        
	$filePath  = Storage::disk('temps')->getDriver()->getAdapter()->getPathPrefix();
	$saveName = $filePath.$filename;

	$objWriter->save($saveName);
        return response()->download($saveName);

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
