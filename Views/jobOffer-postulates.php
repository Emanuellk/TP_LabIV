<?php
    require_once('navAdmin.php');
?>
<br>
<section id = "listado" class="mb-5 bg-light-alpha">
<div class = "container" >
<div style="background-color:primay;" class="table-responsive ">
               <div id="areaImprimir">
               <h2>Historial de postulantes</h2>
               
               
               <table class="table bg-light-alpha table-primary">
                    <thead class="table" style="background-color: orange;"  text-align:center >   
                         <th scope="col">Nombre</th>
                         <th scope="col">Apellido</th>
                         <th scope="col">Email</th>    
                         <th scope="col">Dni</th>
                         <th scope="col">Borrar</th>                           
                    </thead>
                    
                    <tbody>
                    
                    <?php
                    $i=0;
                              foreach($studentsList as $student)
                              {
                                   ?>
                                        <tr style="white-space:nowrap;">
                                       
                                             <td><li class="list-group-item list-group-item-info"><?php echo $student->getFirstName() ?> </li></td>
                                             <td><li class="list-group-item list-group-item-info"><?php echo $student->getLastName() ?></li></td>
                                             <td><li class="list-group-item list-group-item-info"><?php echo $student->getEmail() ?> </li></td>
                                             <td><li class="list-group-item list-group-item-info"><?php echo $student->getDni() ?></li></td>
                                             <td>
                                             <form style="display:inline;" method="POST" action="<?php echo FRONT_ROOT ?>JobOffer/DeletePostulationAdmin">
                                                  
                                                  <input type="hidden" name="id" value="<?php echo $userxofferList[$i]->getId()?>" class="form-control">
                                                  <input type="hidden" name="idOffer" value="<?php echo $userxofferList[$i]->getIdOffer()?>" class="form-control">
                                                  <button type="submit" class="btn btn-danger" title="Eliminar" class="buttonF" ><i class="fas fa-trash-alt"></i></button>                                                 
                                                  </form>
                                             </td>

                                        </tr>
                                <?php
                                $i = $i+1;
                              }
                            ?>
                    </tbody>
                 </table>
                 </div>
                 <input type="button" onclick="printDiv('areaImprimir')" value="Obtener PDF" />
               
</div>   
</div>       
</section>
<script>
function printDiv(nombreDiv) {
var contenido= document.getElementById(nombreDiv).innerHTML;
var contenidoOriginal= document.body.innerHTML;

document.body.innerHTML = contenido;

window.print();

document.body.innerHTML = contenidoOriginal;
}
</script>