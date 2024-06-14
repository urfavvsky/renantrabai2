<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Employee;
 
class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::orderBy('id', 'desc')->get();
        $total = Employee::count();
        return view('admin.employee.home', compact(['employees', 'total']));
    }

    public function create()
    {
        return view('admin.employee.create');
    }

    public function save(Request $request)
    {
        $validation = $request->validate([
            'title' => 'required',
            'data_nasc' => 'required',
            'cpf' => 'required',
        ]);
        $data = Employee::create($validation);
        if ($data) {
            session()->flash('success', 'Produto adicionado com sucesso');
            return redirect(route('admin/employees'));
        } else {
            session()->flash('error', 'Ocorreu um erro');
            return redirect(route('admin.employees/create'));
        }
    }
    public function edit($id)
    {
        $employees = Employee::findOrFail($id);
        return view('admin.employee.update', compact('employees'));
    }
 
    public function delete($id)
    {
        $employees = Employee::findOrFail($id)->delete();
        if ($employees) {
            session()->flash('success', 'Funcionário deletado com sucesso');
            return redirect(route('admin/employees'));
        } else {
            session()->flash('error', 'O Funcionário não pode ser deletado');
            return redirect(route('admin/employees'));
        }
    }
 
    public function update(Request $request, $id)
    {
        $employees = Employee::findOrFail($id);
        $title = $request->title;
        $data_nasc = $request->data_nasc;
        $cpf = $request->cpf;
 
        $employees->title = $title;
        $employees->data_nasc = $data_nasc;
        $employees->cpf = $cpf;
        $data = $employees->save();
        if ($data) {
            session()->flash('success', 'Funcionário atualizado com sucesso');
            return redirect(route('admin/employees'));
        } else {
            session()->flash('error', 'Ocorreu um erro');
            return redirect(route('admin/employees/update'));
        }
    }
}