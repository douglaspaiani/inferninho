<?php

namespace App\Http\Controllers;

use App\Models\Support;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    public function SupportPage(){
        $support = new Support;
        $open = $support->ListSupportOpen();
        $closed = $support->ListSupportClosed();
        return view('app.support.support', ['open' => $open, 'closed' => $closed]);
    }

    public function AddSupport(){
        return view('app.support.addSupport');
    }

    public function AddSupportPost(Request $request){
        $support = new Support;

        try {
            $support->CreateSupport($request);
        } catch (Exception $e){
            return redirect()->route('support')->withErrors(['error' => $e->getMessage()]);
        }
        
        return redirect()->route('support')->with(['success' => 'Chamado aberto com sucesso!']);
    }

    public function ReadSupport(int $id){
        $support = new Support;
        $sup = $support->GetSupport($id);
        // Protect
        if($sup['support']->user != Auth::id()){
            return redirect()->route('support');
        }
        $messages = $support->GetMessagesSupport($id);
        $support->MarkReadUser($id);
        return view('app.support.readSupport', ['support' =>$sup['support'], 'messages' => $messages, 'name'=> $sup['name'], 'photo' => $sup['photo']]);
    }

    public function AddResponseSupport(int $id, Request $request){
        $support = new Support;
        try {
            $support->ResponseSupportUser($id, $request);
        } catch (Exception $e){
            return redirect()->route('support')->withErrors(['error' => $e->getMessage()]);
        }
        
        return redirect()->route('support')->with(['success' => 'Resposta enviada com sucesso!']);
    }

}
