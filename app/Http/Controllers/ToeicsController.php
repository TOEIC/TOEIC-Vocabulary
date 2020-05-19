<?php

namespace App\Http\Controllers;
use App\vocabulary;
use App\uservocabularies;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ToeicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    /*    $vocabularies=DB::select('select * from vocabulary ORDER BY RAND() limit '.auth()->user()->several);
        $data=[
          'vocabularies'=>$vocabularies,
        ];
        return view('toeic.index',$data);
*/


               //判斷當天有無單字沒有就新增
               if(uservocabularies::where('uid','=',auth()->user()->id)->where('svdate','=',date("Y-m-d"))->get()->count()=='0'){

                  $vocabularies=vocabulary::all()->random(auth()->user()->several);

                  $vocabulary_str="";

                  foreach ($vocabularies as $vocabulary) {
                    $vocabulary_str=$vocabulary_str.$vocabulary->num.',';
                  }

                  $vocabulary_str=substr($vocabulary_str,0,-1);


                  $att['svdate'] = date("Y-m-d");
                  $att['uid'] = auth()->user()->id;
                  $att['num'] = auth()->user()->several;
                  $att['vocabularies_id'] = $vocabulary_str;
                  uservocabularies::create($att);
                  return redirect()->route('toeic.index');
                }
                else{

                  $uservocabularies=uservocabularies::where('uid','=',auth()->user()->id)->where('svdate','=',date("Y-m-d"))->get();
                  foreach ($uservocabularies as $uservocabulary) {
                       //讀出使用者每日單字資料
                       $uservc = $uservocabulary->vocabularies_id;
                       //讀出使用者每日單字資料個數
                       $uservc_num = $uservocabulary->num;
                   }//foreach

                   //儲存使用者每日單字陣列
                   $uservc_array=[];
                   //每日單字陣列計數
                   $array_num=1;
                   //取分隔符號目前位置紀錄
                   $i_tmp=0;
                   //把ID字串每個字分出來判斷
                   for($i=1;$i<=strlen($uservc);$i++){
                      //把單字ID分隔(去，)，存入陣列
                      if(substr($uservc,$i-1,1)==','){
                        $uservc_array[$array_num]=substr($uservc,$i_tmp,$i-$i_tmp-1);
                        $i_tmp=$i;
                        $array_num=$array_num+1;
                      }
                      elseif($i==strlen($uservc)){
                        $uservc_array[$array_num]=substr($uservc,$i_tmp,$i-$i_tmp);
                      }
                   }//for
                  //echo $uservc ;

                  $uservocabularies_show=vocabulary::whereIn('num', $uservc_array)->get();

                   $data=[
                     'vocabularies'=>$uservocabularies_show,
                   ];
                   return view('toeic.index',$data);









                }//else
        //******************************************************************************************************************








             //echo $uservc;


      //  return(uservocabularies::where('uid','=',auth()->user()->id)->where('svdate','=',date("Y-m-d"))->get()->count());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($date=null)
    {

      if(isset($date)==false){$date=date("Y-m-d");}

      
      $uservocabularies=uservocabularies::where('uid','=',auth()->user()->id)->where('svdate','=',$date)->get();
      foreach ($uservocabularies as $uservocabulary) {
           //讀出使用者每日單字資料
           $uservc = $uservocabulary->vocabularies_id;
           //讀出使用者每日單字資料個數
           $uservc_num = $uservocabulary->num;
       }//foreach

         //儲存使用者每日單字陣列
         $uservc_array=[];
         //每日單字陣列計數
         $array_num=1;
         //取分隔符號目前位置紀錄
         $i_tmp=0;
         //把ID字串每個字分出來判斷
         for($i=1;$i<=strlen($uservc);$i++){
            //把單字ID分隔(去，)，存入陣列
            if(substr($uservc,$i-1,1)==','){
              $uservc_array[$array_num]=substr($uservc,$i_tmp,$i-$i_tmp-1);
              $i_tmp=$i;
              $array_num=$array_num+1;
            }
            elseif($i==strlen($uservc)){
              $uservc_array[$array_num]=substr($uservc,$i_tmp,$i-$i_tmp);
            }
         }//for
        //echo $uservc ;

        $uservocabularies_show=vocabulary::whereIn('num', $uservc_array)->get();

         $data=[
           'vocabularies'=>$uservocabularies_show,
         ];

         return view('toeic.show',$data);





    }

    public function level($level)
    {
        //
        //$vocabularies=DB::select('select * from vocabulary where level=?',[$level]);

        $vocabularies=vocabulary::where('level','=',$level)->paginate(50);


        $data=[
          'vocabularies'=>$vocabularies,
        ];
        return view('toeic.level',$data);
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
    public function search(Request $request)
    {
        //
        $att['vc']=$request->input('search');
        return redirect('https://dictionary.cambridge.org/zht/%E8%A9%9E%E5%85%B8/%E8%8B%B1%E8%AA%9E-%E6%BC%A2%E8%AA%9E-%E7%B9%81%E9%AB%94/'.$att['vc']);
    }

}
