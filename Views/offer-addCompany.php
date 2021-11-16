<?php
    require_once('navCompany.php');
?>
<div class="container">
                <br>
                <br>
                <h2 class="mb-4">Agregar Empleo</h2>
                <form action="<?php echo FRONT_ROOT ?>JobOffer/Add" method="POST" class="bg-light-alpha p-5">
                
                        <div class="row">                         
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Título</label>
                                    <input type="text" name="title" value="" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Descripción</label>
                                    <input type="text" name="description" value="" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Fecha de Publicacion</label>
                                    <input type="date" name="publicationDate" value="" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Fecha de Expiro</label>
                                    <input type="date" name="expirationDate" value="" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Carga Horaria</label>
                                    <input type="datetime" name="workLoad" value="" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Salario</label>
                                    <input type="number" name="salary" step="0.1" value="" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="">Requisitos</label>
                                    <input type="text" name="requirements" value="" class="form-control" required>
                                </div>
                            </div>
                            
                         <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Empresa</label>
                                   <select class="form-control" name="idCompany">
                                        <?php  foreach($companyList as $company){
                                                   ?>
                                                       <option value=<?php echo $company->getIdCompany() ?>><?php echo $company->getNameCompany() ?></option>
                                        <?php } ?>
                                   </select>
                              </div>
                        </div>
                        <div class="col-lg-4">
                              <div class="form-group">
                                   <label for="">Empleo</label>
                                   <select class="form-control" name="idJobPosition">
                                        <?php  foreach($jobList as $job){
                                                   ?>
                                                       <option value=<?php echo $job->getJobPositionId() ?>><?php echo $job->getDescription() ?></option>
                                        <?php } ?>
                                   </select>
                              </div>
                        <button type="submit" class="btn btn-dark ml-auto d-block">Agregar</button>
                </form>
            </div>
        </section>
</div>