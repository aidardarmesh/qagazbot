<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Terminal;

class TerminalsViewController extends Controller
{

	public function index()
	{

		$terminals = Terminal::all();

		return view('terminals.index', [
										'terminals' => $terminals
										]);

	}
    
	public function addGet()
	{

		return view('terminals.add');

	}

	public function addPost(Request $request)
	{

		$info = $request->all();

		// Ищу уникальный id
        do{

            $id = rand(1000, 9999);
            $terminal = Terminal::find($id);

        } while( $terminal !== null );

        $terminal = new Terminal();
        $terminal->id = $id;
		$terminal->phone = $info['phone'];
		$terminal->traffic = $info['traffic'];
		$terminal->pages = $info['pages'];
		$terminal->toner = $info['toner'];
		$terminal->addr = $info['addr'];
		$terminal->save();

		return redirect('terminals');

	}

	public function details(Terminal $terminal)
	{

		return view('terminals.details', [
								'terminal' => $terminal
								]);

	}

	public function editGet(Terminal $terminal)
	{

		return view('terminals.edit', [
							'terminal' => $terminal
							]);

	}

	public function editPost(Request $request)
	{

		$info = $request->all();
		$terminal = Terminal::find($info['id']);
		$terminal->phone = $info['phone'];
		$terminal->traffic = $info['traffic'];
		$terminal->pages = $info['pages'];
		$terminal->toner = $info['toner'];
		$terminal->done = $info['done'];
		$terminal->addr = $info['addr'];
		$terminal->save();

		return redirect('terminals/' . $terminal->id);

	}

	public function delete(Terminal $terminal)
	{

		$terminal->delete();

		return redirect('terminals');

	}

}
