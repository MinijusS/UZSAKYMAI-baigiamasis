<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $form = [
        'attr' => [
            'action' => '/categories',
        ],
        'fields' => [
            'name' => [
                'type' => 'text',
                'label' => 'Pavadinimas',
                'extras' => [
                    'attr' => [
                        'class' => 'input-css'
                    ]
                ]
            ]
        ],
        'buttons' => [
            'submit' => [
                'title' => 'Sukurti',
                'extras' => [
                    'attr' => [
                        'class' => 'btn btn-primary form-btn'
                    ]
                ]
            ]
        ]
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return abort('404');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create')->with(['form' => $this->form]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string'
        ]);
        $category = new Category($validatedData);
        $category->save();

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $this->form['fields']['name']['value'] = $category->name;
        $this->form['attr']['action'] = route('categories.update', $category->id);
        $this->form['fields']['_method'] = ['type' => 'hidden', 'value' => 'PUT'];
        $this->form['buttons']['submit']['title'] = 'Atnaujinti';

        return view('categories.create')->with(['form' => $this->form]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->update($request->all());

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('products.index');
    }
}
