<?php

namespace SDM\Import;

class Import implements ImportInterface, ProductInterface
{
    /**
     * Importer.
     *
     * @param string $filePath  The path to the csv file
     * @param string $delimiter CSV delimter
     */

    
    $simpleProducts=array();
    $ConfiguruableProducts=array();
    $title=array();
    $attributes=array();
    $stock=array();
    $price=array();     
    $isVisble=array(); 
    $filePath="";
    $delimiter="";

    public function __construct(string $filePath, string $delimiter = ',')
    {
        $this->filePath=$filePath;
        $this->delimiter=$delimiter;

    }
    public function parse()
    {

        $row = 0;
        if (($handle = fopen($this->filepath, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, $this->delimiter)) !== FALSE) {
                    if(++$row>1){
        
                        /**  Define Configurable product:
                             * Check if the product Name has "-"
                             * split and get the word before hyphen and 
                             * add it to the configurable product
                         */
                        if (substr_count($data[0], '-') > 0) {
                            $ConfigProduct=explode("-",$data[0]);
                            if ( (!in_array($ConfigProduct[0], $this->ConfiguruableProducts) ) ){
                                $this->ConfiguruableProducts[] = $ConfigProduct[0];
                            }                   
                        }
                        
                        //store values in configurable prod array
                        $this->simpleProducts[]['sku']=$data[0];
                        $this->simpleProducts[]['title']=$data[1];
                        $this->simpleProducts[]['attributes']=$data[2];
                        $this->simpleProducts[]['stock']=$data[3];
                        $this->simpleProducts[]['price']=$data[4];
                    }
            }
            fclose($handle);
        }        

    }
    public function getProducts()
    {
                     
           
            foreach($this->simpleProducts as $simProd){
            foreach($this->simProd as $prod){
                
                if (substr_count($prod['sku'], '-') > 0) {
                    $ConProd=explode("-",$prod['sku']);
                    $conProdTitle=$ConProd[0];
                    if ( (!in_array($conProdTitle, $this->ConfiguruableProducts) ) ){
                        $this->ConfiguruableProducts[] = $conProdTitle;
                                          
                    }
                        $this->ConfiguruableProducts[$conProdTitle][]['sku'] = $ConProd[0];
                        $this->ConfiguruableProducts[$conProdTitle][]['title'] = $ConProd[0];
                        $this->ConfiguruableProducts[$conProdTitle][]['attributes'] = $ConProd[0];                   
                        $this->ConfiguruableProducts[$conProdTitle][]['attributes'] = $ConProd[0];                   
                        $this->ConfiguruableProducts[$conProdTitle][]['stock'] = $ConProd[0];                   
                        $this->ConfiguruableProducts[$conProdTitle][]['price'] = $ConProd[0]; 
                }  
            }  
            }            
                                                     
    }

    public function getSku()
    {
       foreach ($this->ConfiguruableProducts as $prod) {
                switch ($prod) {
                    case 'table':
                        return $prod['table']['sku'];
                    case 'socks':
                        return $prod['socks']['sku'];
                    case 'chair':
                        return $prod['chair']['sku'];
                    case 'shoe':
                        return $prod['shoe']['sku'];
                    default:
                        throw new \InvalidArgumentException('You have created a configurable product with a SKU it shouldnt have!');
                }
        }
    }
    public function getTitle()
    {
        foreach ($this->ConfiguruableProducts as $prod) {
            switch ($prod) {
                case 'table':
                    return $prod['table']['title'];
                case 'socks':
                    return $prod['socks']['title'];
                case 'chair':
                    return $prod['chair']['title'];
                case 'shoe':
                    return $prod['shoe']['title'];
                default:
                    throw new \InvalidArgumentException('You have created a configurable product with a SKU it shouldnt have!');
            }
        }        
    }    
    public function getPrice()
    {
        foreach ($this->ConfiguruableProducts as $prod) {
            switch ($prod) {
                case 'table':
                    return asort($prod['table']['price'][0]);
                case 'socks':
                    return asort($prod['socks']['price'][0]);
                case 'chair':
                    return asort($prod['chair']['price'][0]);
                case 'shoe':
                    return asort($prod['shoe']['price'][0]);
                default:
                    throw new \InvalidArgumentException('You have created a configurable product with a SKU it shouldnt have!');
            }
        } 
    }     
    public function getAttributes($num)
    {
        foreach ($this->ConfiguruableProducts as $prod) {
            switch ($prod) {
                case 'table':
                    return $prod[$num];
                case 'socks':
                    return $prod[$num];
                case 'chair':
                    return $prod[$num];
                case 'shoe':
                    return $prod[$num];
                default:
                    throw new \InvalidArgumentException('You have created a configurable product with a SKU it shouldnt have!');
            }
        }
    } 
    public function getSimpleProducts()
    {
        return count($this->simpleProducts);
    } 
    public function isInStock()
    {
        foreach ($this->ConfiguruableProducts as $prod) {
            switch ($prod) {
                case 'table':
                    return count($prod['table']['stock')];
                case 'socks':
                    return count($prod['socks']['stock')];
                case 'chair':
                    return count($prod['chair']['stock')];
                case 'shoe':
                    return count($prod['shoe']['stock')];
                default:
                    throw new \InvalidArgumentException('You have created a configurable product with a SKU it shouldnt have!');
            }
        }
        return count($this->simpleProducts);
    }        
}
