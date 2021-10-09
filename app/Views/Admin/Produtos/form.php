<div class="form-row">
             <div class="form-group col-md-9">
               <label for="nome"> Nome: <span class="text-danger">*</span> </label>
               <input type="text" class="form-control" name="nome" id="nome" value="<?php echo old('name', esc($produto->nome));?>">
             </div>
             <div class="form-group col-md-3">
                 <label for="desconto"> Desconto: </label>
                  <select class="form-control form-control-ativo" name="desconto">
                    <option value="">Escolha a desconto...</option>

                      <option value="off" selected="">OFF</option>
                       <option value="5" class="text-success">5%</option>
                       <option value="10" class="text-success">10%</option>
                       <option value="15" class="text-success">15%</option>
                       <option value="20" class="text-success">20%</option>
                       <option value="25" class="text-success">25%</option>
                       <option value="30" class="text-success">30%</option>
                       <option value="40" class="text-success">40%</option>
                       <option value="45" class="text-success">45%</option>
                       <option value="50" class="text-success">50%</option>
                       <option value="55" class="text-success">55%</option>
                       <option value="60" class="text-success">60%</option>
                       <option value="65" class="text-success">65%</option>
                       <option value="70" class="text-success">70%</option>
                       <option value="75" class="text-success">75%</option>
                       <option value="80" class="text-success">80%</option>
                       <option value="85" class="text-success">85%</option>
                       <option value="90" class="text-success">90%</option>
                       <option value="95" class="text-success">95%</option>
                       <option value="100" class="text-success">100%</option>


                 </select>
             </div>
             <div class="form-group col-md-6">
               <label for="ativo"> Categorias: <span class="text-danger">*</span> </label>
               <select class="form-control form-control-ativo" name="categoria_id" required>
                    <option value="">Escolha a categoria...</option>
                    <?php foreach ($categorias as $categoria): ?>
                      <?php if($produto->id): ?>
                         <option value="<?php echo $categoria->id; ?>" <?php echo ($categoria->id == $produto->categoria_id ? 'selected' : ''); ?>><?php echo esc($categoria->nome); ?></option>
                      <?php else: ?>
                      <option value="<?php echo $categoria->id; ?>"><?php echo esc($categoria->nome); ?></option>
                      <?php endif; ?>
                    <?php endforeach; ?>

              </select>
               </div>
             <div class="form-group col-md-6">
									<label for="ativo"> Ativo: <span class="text-danger">*</span> </label>
                  <select class="form-control form-control-ativo" name="ativo" required>
                     <?php if($produto->id): ?>
                       <option value="1"<?php echo ($produto->ativo ? 'selected' : ''); ?>>Sim</option>
                       <option value="0"<?php echo (!$produto->ativo ? 'selected' : ''); ?>>Não</option>
                     <?php else : ?>
                       <option value="1" class="text-success">Sim</option>
                       <option value="0" selected="">Não</option>
                     <?php endif ?>
                 </select>
             </div>
             <div class="form-group col-md-12">
               <label for="nome">Ingredientes: <span class="text-danger">*</span> </label>
               <textarea class="form-control" name="ingredientes" rows="2" id="ingredientes"><?php echo old('name', esc($produto->ingredientes));?></textarea>
               </div>
           </div>
             <button type="submit" class="btn btn-primary mr-2 btn-sm"><i class=" mdi mdi-content-save btn-icon-prepend mr-1"></i>Salvar
             </button>
