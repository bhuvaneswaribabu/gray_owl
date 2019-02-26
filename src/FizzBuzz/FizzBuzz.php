<?php



namespace SDM\FizzBuzz;

class FizzBuzz implements FizzBuzzInterface
{
    $testNumber;
    $fizz=3;
    $buzz=5;
    
                
        public function getResults($testNumber, $fizz,  $buzz ){
            try {
                if ($testNumber <1 || $testNumber >100 ) {
                throw new Exception("The number is not valid."); 
                }

                if(  !($testNumber % ($fizz*$buzz) )     ){
                    return "FizzBuzz";
                }
                elseif (  !($testNumber % $buzz )     ){
                    return "Buzz";
                }
                elseif(  !($testNumber % $fizz )     ){
                    return "Fizz";
                } 
                else {
                    return $testNumber;
                }
            }
            catch (Exception $e) {
                    echo "The number is not valid.";
            }        

        }

        public function getResults($testNumber){
            try {
                if ($testNumber <1 || $testNumber >100 ) {
                throw new Exception("The number is not valid."); 
                }

                if(  !($testNumber % ($this->fizz*$this->buzz) )     ){
                    return "FizzBuzz";
                }
                elseif (  !($testNumber % $this->buzz )     ){
                    return "Buzz";
                }
                elseif(  !($testNumber % $this->fizz )     ){
                    return "Fizz";
                } 
                else {
                    return $testNumber;
                }
            }
            catch (Exception $e) {
                    echo "The number is not valid.";
            }        

        }        
}

?>