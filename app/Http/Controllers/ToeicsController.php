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
      /*  $vocabularies=DB::select('select * from vocabulary ORDER BY RAND() limit '.auth()->user()->several);
        $data=[
          'vocabularies'=>$vocabularies,
        ];
        return view('toeic.index',$data);*/


    /*    $uservocabularies_count =uservocabularies::withCount(['uservocabularies' => function ($query) {
        $query->where('uid','=',auth()->user()->id)->where('svdate','=',date("Y-m-d"));}])->get();*/







       if(uservocabularies::where('uid','=',auth()->user()->id)->where('svdate','=',date("Y-m-d"))->get()->count()=='0'){

          $att['svdate'] = date("Y-m-d");
          $att['uid'] = auth()->user()->id;
          $att['num'] = auth()->user()->several;
          $att['vocabularies_id'] = '2,4,6,8,10,12,14,16,18,20';
          uservocabularies::create($att);
          return redirect()->route('toeic.index');





        }else{

          $uservocabularies=uservocabularies::where('uid','=',auth()->user()->id)->where('svdate','=',date("Y-m-d"))->get();
          foreach ($uservocabularies as $uservocabulary) {
               $uservc = $uservocabulary->vocabularies_id;
           }
           $data=[
             'vocabularies_id'=>$uservc,
           ];

          return view('toeic.index',$data);

        }
//

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
        //
        $data=[
          'date'=>$date
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

    /*public function level($level=null)
    {
        //
        //$vocabularies=DB::select('select * from vocabulary where level=?',[$level]);

        $vocabularies=vocabulary::where('level','=',$level)->paginate(50);


        $data=[
          'vocabularies'=>$vocabularies,
        ];
        return view('toeic.level',$data);
    }*/

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
