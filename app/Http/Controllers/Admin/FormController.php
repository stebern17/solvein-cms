<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\EmailForm;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::latest()->paginate(10, ['*'], 'forms_page');
        $emailForms = EmailForm::latest()->paginate(10, ['*'], 'email_forms_page');

        return view('admin.form.index', compact('forms', 'emailForms'));
    }

    public function show(Form $form)
    {
        return view('admin.form.show', compact('form'));
    }

    public function showEmailForm(EmailForm $emailForm)
    {
        return view('admin.form.show_email', compact('emailForm'));
    }

    public function destroy(Form $form)
    {
        $form->delete();
        return redirect()->route('admin.form.index')->with('success', 'Form entry deleted successfully.');
    }

    public function destroyEmailForm(EmailForm $emailForm)
    {
        $emailForm->delete();
        return redirect()->route('admin.form.index')->with('success', 'Email form entry deleted successfully.');
    }
}
