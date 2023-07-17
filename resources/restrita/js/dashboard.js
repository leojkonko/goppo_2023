import ActiveController from "./controllers/active_controller";
import UploadController from "./controllers/upload_controller";
import Sortable from "./controllers/sortable";
import PermissionsSelect from "./controllers/permissions_select";

// Controllers do stimulus
application.register("active", ActiveController);
application.register("upload", UploadController);

// Executa sortable quando framework turbo carregar
Sortable();

// Selecionar/deselecionar todas as permissões na tela de níveis
PermissionsSelect();
