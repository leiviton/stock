<?php
/**
 * Created by PhpStorm.
 * User: leviton
 * Date: 17/08/2016
 * Time: 15:26
 */

namespace Stock\Http\Controllers\Api\V1\Admin;

use Stock\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stock\Mail\IntegrationBankIdeia;
use Stock\Repositories\BankIdeaRepository;
use Illuminate\Support\Facades\Mail;

class BankIdeaController extends Controller
{
    /**
     * @var BankIdeaRepository
     */
    private $repository;

    /**
     * BankIdeaController constructor.
     * @param BankIdeaRepository $repository
     */
    public function __construct(BankIdeaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function index()
    {
        return $this->repository->paginate();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $result = $this->repository->create($data);

        if ($result->id) {
            //dd("aquu");
            $ideia = $this->repository->find($result->id);

            Mail::queue(new IntegrationBankIdeia("inova@drsgroup.com.br", $ideia));

            return response()->json(['message' => 'Idea enviada com sucesso', 'status' => 'success',
                'title' => 'Sucesso'], 201);
        } else {
            return response()->json(['message' => $result['message'], 'status' => 'error',
                'title' => 'Erro'], 400);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        return $this->repository->find($id);
    }
}
