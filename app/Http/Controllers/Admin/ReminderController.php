<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reminder;
use Illuminate\Support\Str;

class ReminderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reminders = Reminder::all();
        return view('admin.reminder.index', compact('reminders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.reminder.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:100|min:2',
            'description' => 'required|max:65535|min:2',
            'status' => 'required|max:255|min:2'
        ]);

        $reminder = $request->all();
        $newReminders = new Reminder();
        $newReminders->fill($reminder);

        $slug = $this->getUniqueSlug($newReminders->title);
        $newReminders->slug = $slug;
        $newReminders->save();

        return redirect()->route('admin.reminder.index')->with('create', 'Item created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reminder = Reminder::findOrFail($id);
        return view('admin.reminder.show', compact('reminder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reminder = Reminder::findOrFail($id);
        return view('admin.reminder.edit', compact('reminder'));
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
        $request->validate([
            'title' => 'required|max:100|min:2',
            'description' => 'required|max:65535|min:2',
            'status' => 'required|max:255|min:2'
        ]);

        $reminder = Reminder::findOrFail($id);
        $data = $request->all();

        if ($reminder->title !== $data['title']) {
            $data['slug'] = $this->getUniqueSlug($data['title']);
        }

        $reminder->update($data);
        $reminder->save();

        return redirect()->route('admin.reminder.index', ['reminder' => $reminder])->with('update', 'Item updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reminder = Reminder::findOrFail($id);
        $reminder->delete();

        return redirect()->route('admin.reminder.index', ['reminder' => $reminder])->with('status', 'Item deleted');
    }

    protected function getUniqueSlug($name){

        $slug = Str::slug($name, '-');

        $checkSlug = Reminder::where('slug', $slug)->first();

        $count = 1;

        while ($checkSlug) {
            $slug = Str::slug($name, '-' . $count, '-');
            $count++;
            $checkSlug = Reminder::where('slug', $slug)->first();
        }

        return $slug;
    }
}
