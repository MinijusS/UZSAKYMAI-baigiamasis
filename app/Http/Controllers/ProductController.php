<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\StoreProductPost;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $form = [
        'attr' => [
            'action' => '/products',
            'class' => 'create-product',
            'enctype' => 'multipart/form-data'
        ],
        'fields' => [
            'name' => [
                'type' => 'text',
                'label' => 'Pavadinimas',
                'placeholder' => '',
                'value' => '',
                'extras' => [
                    'attr' => [
                        'class' => 'input-css'
                    ]
                ]
            ],
            'description' => [
                'type' => 'textarea',
                'label' => 'Aprasymas/Sudetis',
                'placeholder' => '',
                'value' => '',
                'extras' => [
                    'attr' => [
                        'class' => 'input-css'
                    ]
                ]
            ],
            'price_big' => [
                'type' => 'number',
                'label' => 'Dideles porcijos kaina',
                'placeholder' => '',
                'value' => '',
                'step' => 0.01,
                'extras' => [
                    'attr' => [
                        'class' => 'input-css'
                    ]
                ]
            ],
            'price_small' => [
                'type' => 'number',
                'label' => 'Mazos porcijos kaina',
                'placeholder' => '',
                'value' => '',
                'step' => 0.01,
                'extras' => [
                    'attr' => [
                        'class' => 'input-css'
                    ]
                ]
            ],
            'category_id' => [
                'type' => 'select',
                'label' => 'Kategorija',
                'value' => '',
                'options' => [],
                'placeholder' => 'Pasirinkti',
                'extras' => [
                    'attr' => [
                        'class' => 'input-css'
                    ]
                ]
            ],
            'photo' => [
                'type' => 'file',
                'label' => 'Nuotrauka',
                'placeholder' => '',
                'value' => '',
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

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $table = [
            'thead' => [
                'Pavadinimas', 'Aprašymas', 'Kategorija', 'Kaina M.', 'Kaina D.', 'Nuotrauka', 'Veiksmai', ''
            ],
            'tbody' => []
        ];

        foreach ($products as $product_id => $product) {
            $category = Category::find($product->category_id);


            $buttons = [
                [
                    'name' => '<i class="material-icons">create</i>',
                    'href' => route('products.edit', $product->id),
                    'class' => 'btn-primary'
                ],
                [
                    'method' => 'Delete',
                    'name' => '<i class="material-icons">close</i>',
                    'href' => route('products.destroy', $product->id),
                    'class' => 'btn-danger'
                ]
            ];

            $table['tbody'][$product_id]['name'] = $product->name;
            $table['tbody'][$product_id]['description'] = $product->description;
            $table['tbody'][$product_id]['category_id'] = $category != null ? $category->name : 'Nera kategorijos';
            $table['tbody'][$product_id]['price_small'] = $product->price_small . '€';
            $table['tbody'][$product_id]['price_big'] = $product->price_big . '€';
            $table['tbody'][$product_id]['photo'] = $product->photo;
            $table['tbody'][$product_id]['actions'] = $buttons;
        }

        $categories = Category::all();
        $category_table = [
            'thead' => [
                'Kategorija', 'Veiksmai', ''
            ],
            'tbody' => []
        ];

        foreach ($categories as $category_id => $category) {
            $buttons = [
                [
                    'name' => '<i class="material-icons">create</i>',
                    'href' => route('categories.edit', $category->id),
                    'class' => 'btn-primary'
                ],
                [
                    'method' => 'Delete',
                    'name' => '<i class="material-icons">close</i>',
                    'href' => route('categories.destroy', $category->id),
                    'class' => 'btn-danger'
                ]
            ];

            $category_table['tbody'][$category_id]['name'] = $category->name;
            $category_table['tbody'][$category_id]['actions'] = $buttons;
        }

        return view('products.index')->with(['category_table' => $category_table, 'products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        foreach ($categories as $category) {
            $this->form['fields']['category_id']['options'][$category->id] = $category->name;
        }
        return view('products.create')->with(['form' => $this->form]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param StoreProductPost $validate
     * @return void
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price_small' => 'required|numeric',
            'price_big' => 'required|numeric',
            'category_id' => 'required|numeric',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $imageName = time() . '.' . $request->photo->extension();

        $request->photo->move(public_path('images'), $imageName);

        $validatedData['photo'] = 'images/' . $imageName;

        $product = new Product($validatedData);
        $product->save();

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        foreach ($categories as $category) {
            $this->form['fields']['category_id']['options'][$category->id] = $category->name;
        }

        $this->form['attr']['action'] = route('products.update', $product->id);

        foreach ($this->form['fields'] as $index => $field) {
            $this->form['fields'][$index]['value'] = $product->$index;
        }

        $this->form['fields']['_method'] = ['type' => 'hidden', 'value' => 'PUT'];
        $this->form['buttons']['submit']['title'] = 'Atnaujinti';

        return view('products.edit')->with(['form' => $this->form, 'product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price_small' => 'required|numeric',
            'price_big' => 'required|numeric',
            'category_id' => 'required|numeric'
        ]);

        if (isset($request->photo)) {
            $imageName = time() . '.' . $request->photo->extension();

            $request->photo->move(public_path('images'), $imageName);

            $validatedData['photo'] = 'images/' . $imageName;
        } else {
            $validatedData['photo'] = $product->photo;
        }

        $product->update($validatedData);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index');
    }
}
