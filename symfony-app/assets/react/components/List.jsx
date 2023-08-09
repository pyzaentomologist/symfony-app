import React from "react";

export default function List(props) {
  return (
    <ol className="text-3xl list-decimal list-inside">
      {props.users.map((user, index) => {
        return (
          <li key={index}>
            {user.username}
            <div>
              <a href={`/admin/${user.id}`} className="m-8">
                Edytuj {user.id}
              </a>
              <button
                onClick={() => props.handleDelete(user.id, user.username)}
              >
                Usuń
              </button>
            </div>
          </li>
        );
      })}
    </ol>
  );
}
