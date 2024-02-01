import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-navigation-menu',
  templateUrl: './navigation-menu.component.html',
  styleUrls: ['./navigation-menu.component.css']
})
export class NavigationMenuComponent implements OnInit {
  statusDrawer:boolean = true

  constructor() { }

  ngOnInit(): void {

  }

  toggleDrawer(){
    const drawer = document.querySelector('#drawer')
    const body = document.querySelector('body')

    drawer?.classList.toggle('transform-none')
    body?.classList.toggle('overflow-hidden')

    drawer?.setAttribute('aria-modal',`${this.statusDrawer}`)

    if(this.statusDrawer){
      drawer?.setAttribute('role',`dialog`)
      document.querySelector('.z-30')?.classList.remove('hidden')
    }else{
      document.querySelector('.z-30')?.classList.add('hidden')
      drawer?.removeAttribute('role')
    }

    this.statusDrawer = !this.statusDrawer


  }


}
