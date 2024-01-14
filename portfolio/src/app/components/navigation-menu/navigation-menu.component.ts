import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-navigation-menu',
  templateUrl: './navigation-menu.component.html',
  styleUrls: ['./navigation-menu.component.css']
})
export class NavigationMenuComponent implements OnInit {
  menuSandwichVisibility:string = "hidden"

  constructor() { }

  ngOnInit(): void {
  }

  toggleMenuSandwich():void{
    if(this.menuSandwichVisibility){
      this.menuSandwichVisibility = ""
      return
    }
    this.menuSandwichVisibility = "hidden"
  }
}
