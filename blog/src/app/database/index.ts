import { Database } from '../models/database';

const dataBase:Database =
  {
    about :
    {
        id:"1",
        photoCover:"https://img.freepik.com/fotos-gratis/paisagem-de-nevoeiro-matinal-e-montanhas-com-baloes-de-ar-quente-ao-nascer-do-sol_335224-794.jpg",
        photoProfile:"https://upload.wikimedia.org/wikipedia/commons/3/34/PICA.jpg",
        name: "Carlos Douglas",
        position: "Desenvolvedor Web Full Stack",
        title: "Hello There",
        description: "",
        socialMedia:[
            {
              id:"1",
              name:"Facebook",
              icon: ""
            },
            {
              id:"2",
              name:"Instagram",
              icon: ""
            },
            {
              id:"3",
              name:"Linkedin",
              icon: ""
            },

        ],
    },
    skills:
  {
    id:'1',
    icon:'',
    name:'Front-end',
    tags:['html','css','js'],
  },
  whorks:
  {
    id:'1',
    thumbnail:'',
    name:'Achaí',
    tags:['html','css','js'],
    description:'',
    repository:'',
    documentation:'',
  },

    settings:
    [
      {
        id:"1",
        appName:"Carlos Portfólio",
      }
    ]

}

export {dataBase}
