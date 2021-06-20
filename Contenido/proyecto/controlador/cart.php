<?php 
if(!isset($_SESSION)){
    session_start();
}
class Cart {
    protected $cart_contents = array();
    
    public function __construct(){
        // obtengo el array del carrito de la compra de la sesión
        $this->cart_contents = !empty($_SESSION['cart_contents'])?$_SESSION['cart_contents']:NULL;
        if ($this->cart_contents === NULL){
            // establezco algunos valores base 
            $this->cart_contents = array('cart_total' => 0, 'total_items' => 0);
        }
    }
    
    /**
     * Contenido del carrito de la compra: Devuelve todo el array del carrito
     * @param    bool
     * @return    array
     */
    public function contents(){
        // Reorganizo el carrito poniendo lo más nuevo primero
        $cart = array_reverse($this->cart_contents);

        // Elimino para que no creen un problema al mostrar la tabla del carrito
        unset($cart['total_items']);
        unset($cart['cart_total']);

        return $cart;
    }
    
    /**
     * Obtengo artículos del carrito: Devuelve los detalles de un artículo específico del carrito
     * @param    string    $row_id
     * @return    array
     */
    public function get_item($row_id){
        return (in_array($row_id, array('total_items', 'cart_total'), TRUE) OR ! isset($this->cart_contents[$row_id]))
            ? FALSE
            : $this->cart_contents[$row_id];
    }
    
    /**
     * Total de artículos en el carrito: Devuelve el recuento total de artículos.
     * @return    int
     */
    public function total_items(){
        return $this->cart_contents['total_items'];
    }
    
    /**
     * Total del carrito: Devuelve el precio total.
     * @return    int
     */
    public function total(){
        return $this->cart_contents['cart_total'];
    }
    
    /**
     * Inserta árticulos en el carrito y los guarda en la sesion.
     * @param    array
     * @return    bool
     */
    public function insert($item = array()){
        if(!is_array($item) OR count($item) === 0){
            return FALSE;
        }else{
            if(!isset($item['id'], $item['nombre'], $item['precio'], $item['qty'])){
                return FALSE;
            }else{
                /*
                 * Insert Item
                 */
                // preparo la cantidad
                $item['qty'] = (float) $item['qty'];
                if($item['qty'] == 0){
                    return FALSE;
                }
                // preparo el precio
                $item['precio'] = (float) $item['precio'];
                // crea un identificador único para el artículo que se inserta en el carrito
                $rowid = md5($item['id']);
                // obtenga la cantidad si está lista y la agrega
                $old_qty = isset($this->cart_contents[$rowid]['qty']) ? (int) $this->cart_contents[$rowid]['qty'] : 0;
                // re-create the entry with unique identifier and updated quantity
                $item['rowid'] = $rowid;
                $item['qty'] += $old_qty;
                $this->cart_contents[$rowid] = $item;
                
                // Guarda artículo del carrito
                if($this->save_cart()){
                    return isset($rowid) ? $rowid : TRUE;
                }else{
                    return FALSE;
                }
            }
        }
    }
    
    /**
     * Actualizar carrito
     * @param    array
     * @return    bool
     */
    public function update($item = array()){
        if (!is_array($item) OR count($item) === 0){
            return FALSE;
        }else{
            if (!isset($item['rowid'], $this->cart_contents[$item['rowid']])){
                return FALSE;
            }else{
                // preparo la cantidad
                if(isset($item['qty'])){
                    $item['qty'] = (float) $item['qty'];
                    // Si la cantidad es 0 , remueve el objeto del carro
                    if ($item['qty'] == 0){
                        unset($this->cart_contents[$item['rowid']]);
                        return TRUE;
                    }
                }
                $keys = array_intersect(array_keys($this->cart_contents[$item['rowid']]), array_keys($item));
                // preparo el precio
                if(isset($item['precio'])){
                    $item['precio'] = (float) $item['precio'];
                }
                foreach(array_diff($keys, array('id', 'nombre')) as $key){
                    $this->cart_contents[$item['rowid']][$key] = $item[$key];
                }
                // Guardo los datos del carrito
                $this->save_cart();
                return TRUE;
            }
        }
    }
    
    /**
     * Guardo el array del carro de la compra en la sesion
     * @return    bool
     */
    protected function save_cart(){
        $this->cart_contents['total_items'] = $this->cart_contents['cart_total'] = 0;
        foreach ($this->cart_contents as $key => $val){
            if(!is_array($val) OR !isset($val['precio'], $val['qty'])){
                continue;
            }
            $this->cart_contents['cart_total'] += ($val['precio'] * $val['qty']);
            $this->cart_contents['total_items'] += $val['qty'];
            $this->cart_contents[$key]['subtotal'] = ($this->cart_contents[$key]['precio'] * $this->cart_contents[$key]['qty']);
        }
        
        // si el carrito está vacío, lo elimíno de la sesión
        if(count($this->cart_contents) <= 2){
            unset($_SESSION['cart_contents']);
            return FALSE;
        }else{
            $_SESSION['cart_contents'] = $this->cart_contents;
            return TRUE;
        }
    }
    
    /**
     * Eliminar artículo: Elimino artículo del carrito
     * @param    int
     * @return    bool
     */
    public function remove($row_id){
        // unset & save
        unset($this->cart_contents[$row_id]);
        $this->save_cart();
        return TRUE;
    }

    /**
     * Destruye el carrito: Cuando el carrito está vacio lo destruyo de la sesion
     * @return    void
     */
    public function destroy(){
        $this->cart_contents = array('cart_total' => 0, 'total_items' => 0);
        unset($_SESSION['cart_contents']);
    }
}