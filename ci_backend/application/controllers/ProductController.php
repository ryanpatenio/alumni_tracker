<?php


class ProductController extends BE_Controller{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Common_model');
        
    }

    public function getAll(){
        $query = "SELECT * FROM product WHERE Active = 'A' ORDER BY id";
        $result = $this->Common_model->regular_query($query);

        $message = [
            'code'      => EXIT_BE_ERROR,
            'message'   => 'No records to display.'
         ];
    
        $this->custom_exception->show_result([
            'code'      => EXIT_SUCCESS,
            'message'   => 'OK',
            'result'    => $result
        ]);
    }

    public function insert(){
        $product_name = $this->message['product_name'];

        $query = "INSERT INTO Product (product_name,Active) VALUES(?,'A')";

        $param = [$product_name];

        $result = $this->Common_model->regular_query($query,$param);

        $message = [
            'code'      => EXIT_BE_ERROR,
            'message'   => 'An error occured while processing your request.'
        ];

        if(!empty($result)) {
            $id 		= $result['insert_id'];            

            $query      = "SELECT * FROM Product WHERE Id = ?";
            $params     = [ $id ];
            $result     = $this->Common_model->regular_query($query, $params);

            $message = [
                'code'      => EXIT_BE_ERROR,
                'message'   => 'No record to display.'
            ];

            if(!empty($result)) {
                $message = [
                    'code'      => EXIT_SUCCESS,
                    'message'   => 'OK',
                    'result'    => $result
                ];
            }
        }

        $this->custom_exception->show_result($message);

    }

    public function Get()
    {
        try {
            $filter = $this->message['filter'];
            $id = $filter['id'];

            $query = "SELECT * FROM Product WHERE Id = ?";
            $params = [$id];
            $result = $this->Common_model->regular_query($query, $params);

            $message = [
                'code' => EXIT_BE_ERROR,
                'message' => 'No record to display.'
            ];

            if (!empty($result)) {
                $message = [
                    'code' => EXIT_SUCCESS,
                    'message' => 'OK',
                    'result' => $result
                ];
            }

            $this->custom_exception->show_result($message);

        } catch (Exception $e) {
            $this->custom_exception->show_error([
                'code' => EXIT_BE_ERROR,
                'message' => $e->getMessage()
            ]);
        }
    }


    public function update(){
        $product_name = $this->message['product_name'];

        #id
        $id = $this->message['id'];


        $query = "UPDATE Product SET product_name = ? WHERE id = ?";

        $param = [$product_name,$id];

        $result = $this->Common_model->regular_query($query,$param);

        $message = [
            'code'      => EXIT_BE_ERROR,
            'message'   => 'An error occured while processing your request.'
        ];


        if(!empty($result)) {
            $query      = "SELECT * FROM Product WHERE id = ?";
            $params     = [ $id ];
            $result     = $this->Common_model->regular_query($query, $params);

            $message = [
                'code'      => EXIT_BE_ERROR,
                'message'   => 'No record to display.'
            ];

            if(!empty($result)) {
                $message = [
                    'code'      => EXIT_SUCCESS,
                    'message'   => 'OK',
                    'result'    => $result
                ];
            }
        }

        $this->custom_exception->show_result($message);
    }

    public function Delete()
    {
        $id         = $this->message['id'];

        $query      = "UPDATE Product SET Active = 'I', modified = CURRENT_TIMESTAMP() WHERE Id = ?";

        $params     = [ $id ];
        $result     = $this->Common_model->regular_query($query, $params);

        $message = [
            'code'      => EXIT_BE_ERROR,
            'message'   => 'An error occured while processing your request.'
        ];

        if( ! empty($result)) {
            $message = [
                'code'      => EXIT_SUCCESS,
                'message'   => 'OK',
                'result'    => $result
            ];
        }

        $this->custom_exception->show_result($message);
    }
}

