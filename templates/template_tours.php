      <article>
         <header>
            <h1>Tour Dates</h1>
          </header>          
        <?php 
        $pagination = $this->getPagination();            
        foreach($data as $row) { //generates error when table empty
                  $row = sanitize($row, 1);
                    echo<<<_END
                      <div><p>$row[tour_date] $row[town] $row[place] $row[type] </p></div>                                                              
_END;
                }
         echo $pagination['pagination']; ?>               
        </article>
