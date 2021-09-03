      <div class="form-row">
             <div class="form-group col-md-4">
               <label for="nome"> Nome: <span class="text-danger">*</span> </label>
               <input type="text" class="form-control" name="nome" id="nome" value="<?php echo old('name', esc($usuario->nome));?>">
             </div>
             <div class="form-group col-md-2">
               <label for="cpf"> CPF: <span class="text-danger">*</span> </label>
               <input type="text" class="form-control cpf" id="cpf" name="cpf" value="<?php echo old('cpf', esc($usuario->cpf));?>">
             </div>
             <div class="form-group col-md-3">
               <label for="telefone">Telefone</label>
               <input type="text" class="form-control phone_with_ddd" id="telefone"
               name="telefone" value="<?php echo old('telefone', esc($usuario->telefone));?>">
             </div>
             <div class="form-group col-md-3">
               <label for="email"> Email: <span class="text-danger">*</span> </label>
               <input type="email" class="form-control"name="email" id="email" value="<?php echo old('email', esc($usuario->email));?>">
             </div>
            </div>
            <div class="form-row">
             <div class="form-group col-md-3">
               <label for="senha"> Senha: <span class="text-danger">*</span> </label>
               <input type="password" name="password" class="form-control" id="senha" value="<?php echo esc($usuario->senha);?>" >
             </div>
             <div class="form-group  col-md-3">
               <label for="password_confirmation"> Confirmação de senha: <span class="text-danger">*</span> </label>
               <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" value="<?php echo esc($usuario->email);?>">
             </div>
             <div class="form-group col-md-3">
                 <label for="ativo"> Perfil de acesso: <span class="text-danger">*</span> </label>
               <select class="form-control form-control" name="is_admin" required>
                  <?php if($usuario->id): ?>
                    <option value="1"<?php echo ($usuario->is_admin ? 'selected' : ''); ?>>Administrador</option>
                    <option value="0"<?php echo (!$usuario->is_admin ? 'selected' : ''); ?>>Cliente</option>
                  <?php else : ?>
                    <option value="1" class="text-success">Administrador</option>
                    <option value="0" selected="">Cliente</option>
                  <?php endif ?>
              </select>
             </div>
             <div class="form-group col-md-3">
									<label for="ativo"> Ativo: <span class="text-danger">*</span> </label>
                  <select class="form-control form-control-ativo" name="ativo" required>
                     <?php if($usuario->id): ?>
                       <option value="1" <?= set_select('ativo', '1', TRUE) ?><?php echo ($usuario->ativo ? 'selected' : ''); ?>>Sim</option>
                       <option value="0" <?= set_select('ativo', '0',TRUE) ?><?php echo (!$usuario->ativo ? 'selected' : ''); ?>>Não</option>
                     <?php else : ?>
                       <option value="1" class="text-success">Sim</option>
                       <option value="0" selected="">Não</option>
                     <?php endif ?>
                 </select>
             </div>
           </div>
             <button type="submit" class="btn btn-primary mr-2 btn-sm"><i class=" mdi mdi-content-save btn-icon-prepend mr-1"></i>Salvar
             </button>
