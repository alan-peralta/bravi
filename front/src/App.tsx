import {
  Admin,
  Resource
} from "react-admin";
import { dataProvider } from "./dataProvider";
import { UserList } from "./users/list";
import UserShow from "./users/show";
import UserCreate from "./users/create";
import UserEdit from "./users/edit";

export const App = () => (
  <Admin dataProvider={dataProvider}>
    <Resource
      options={{ label: "Usuários" }}
      name="users"
      list={UserList}
      show={UserShow}
      create={UserCreate}
      edit={UserEdit}
    />
  </Admin>
);
